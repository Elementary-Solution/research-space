<?php

namespace App\Http\Controllers\MobileApp;

use App\Http\Controllers\Controller;

use App\Models\categories;
use App\Models\country;
use App\Models\Reaction;
use App\Models\store;
use App\Models\Contact;
use App\Models\coupon;
use App\Models\Newsletter;
use App\Models\media;
use App\Models\Slider;
use App\Models\blog;
use App\Models\Videoshow;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use http\Url;
use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;

class MainAppController extends Controller
{


    public function AllStores(Request $request)
    {
        $stores = [];
        $data =  store::select('stores.*')->leftJoin('media', function($join) {
            $join->on('stores.id', '=', 'media.reference_id');
        })
            ->where('status',1)
            ->where('reference_type','=','store')
            ->where('stores.id','>',isset($request->since_id) ? $request->since_id : 0)
            ->select('stores.id','stores.title','stores.slug','media.image')
        ;
        if(isset($request->paginate)) {
            $data = $data->paginate($request->paginate);
        }else{
            $data = $data->get();
        }
        foreach ($data as $row){
            $stores[] = [
                'id' => $row->id,
                'title' => $row->title,
                'slug' => $row->slug,
                'image' => asset('/images/media/'.$row->image),
            ];
        }
        if ($stores != null) {
            return $stores;
        } else {
            return ['success' => false, 'message' => 'No Stores Found.'];
        }
    }


    public function Filterations(Request $request)
    {
        $query = coupon::where('status', 1);
        if(isset($request->since_id)){
            $query = $query ->where('id','<',$request->since_id);
        }
        if(isset($request->store) != null){
            $query->where('fullfilled',$request->store);
        }
        if(isset($request->category) != null){
            $query->where('category_id',$request->category);
        }
        if(isset($request->discount) != null && $request->discount != 'all' ){
//            dd($request->discount);
            $serial = (unserialize($request->discount));
            $query->whereBetween('discount', [$serial['min'], $serial['max']]);
        }
        if(isset($request->sort) != null)
        {
            if($request->sort == '0'){
                $query->orderBy('id', 'asc');
            }
            elseif($request->sort == '1') {
                $query->orderBy('regular_price', 'asc');
            }
            elseif($request->sort == '2'){
                $query->orderBy('regular_price', 'desc');
            }
            else
            {
                $query->orderBy('id', 'desc');
            }
        }
        if(isset($request->paginate)){
            $coupon = $query->orderBy('id', 'DESC')->paginate($request->paginate);
            $total=$coupon->total();
        }else{
            $coupon = $query->orderBy('id', 'DESC')->get();
            $total=count($coupon);
        }
        $coupon = $this->getCouponDetail($coupon,$total,$request);
        if ($coupon != null) {
            return $coupon;
        } else {
            return ['success' => false, 'message' => 'No Coupon Found.'];
        }
    }


    public function CouponAgainstDomain(Request $request)
    {


       $store = store::where('domain_name',$request->domain_name)->get()->first();
     if($store != null){


        $query = coupon::where('status', 1);
        $query = $query->where('store_id',$store->id);
        $query = $query->where('coupon_type','coupon');
        if(isset($request->since_id)){
            $query = $query ->where('id','<',$request->since_id);
        }



        $query = $query->select(
            'coupons.title',
            'coupons.category_id',
            'coupons.store_id',
            'coupons.slug',
            'coupons.regular_price',
            'coupons.affiliate_url',
            'coupons.compare_price',
            'coupons.id',
            'coupons.coupon_type',
            'coupons.coupon_code',
            'coupons.discount',
//            'coupons.expiry_date',
            'coupons.country_id'
        );
        //Pagination
        if(isset($request->paginate)){
            $coupon = $query->orderBy('id', 'DESC')->paginate($request->paginate);
            $total=$coupon->total();
        }else{
            $coupon = $query->orderBy('id', 'DESC')->get();
            $total=count($coupon);
        }
        $coupon = $this->getCouponDetail($coupon,$total,$request);



        if ($coupon != null) {
            return $coupon;

        } else {
            return [];
//            return ['success' => false, 'message' => 'No Coupon Found.'];
        }
     }
     else{
         return 'store not found';
     }

    }



    public function AllCoupons(Request $request)
    {


        $coun = 226;
        $query = coupon::where('status', 1);

        if(isset($request->since_id)){
            $query = $query ->where('id','<',$request->since_id);
        }
        if(isset($request->category_id)){
            $query = $query->where('category_id',(int)$request->category_id);
        }
        if(isset($request->category_ids)){
            $category_ids = json_decode($request->category_ids, true);

            $query = $query->whereIn('category_id',$category_ids);
        }
        if(isset($request->search)){
            $query = $query->where('title', 'like', "%$request->search%");
        }
        if (isset($request->store_id)){
            $query = $query->where('store_id',$request->store_id);
        }
        if (isset($request->type)){
            $query = $query->where('coupon_type',$request->type);
        }
        if (isset($request->graph)){
            $query = $query->whereJsonContains('coupon_graph',$request->graph);
        }
        if(isset($request->discount) != null && $request->discount != 'all' ){
            $serial = (unserialize($request->discount));
            $query->whereBetween('discount', [$serial['min'], $serial['max']]);
        }
        if(isset($request->sort) != null)
        {
            if($request->sort == '0'){
                $query->orderBy('id', 'asc');
            }
            elseif($request->sort == '1') {
                $query->orderBy('regular_price', 'asc');
            }
            elseif($request->sort == '2'){
                $query->orderBy('regular_price', 'desc');
            }
            else
            {
                $query->orderBy('id', 'desc');
            }
        }



        $query = $query->select(
            'coupons.title',
            'coupons.category_id',
            'coupons.store_id',
            'coupons.slug',
            'coupons.regular_price',
            'coupons.affiliate_url',
            'coupons.compare_price',
            'coupons.id',
            'coupons.discount',
//            'coupons.expiry_date',
            'coupons.country_id'
        );
        //Pagination
        if(isset($request->paginate)){
            $coupon = $query->orderBy('id', 'DESC')->paginate($request->paginate);
            $total=$coupon->total();
        }else{
            $coupon = $query->orderBy('id', 'DESC')->get();
            $total=count($coupon);
        }
        $coupon = $this->getCouponDetail($coupon,$total,$request);



        if ($coupon != null) {
            return $coupon;

        } else {
            return [];
//            return ['success' => false, 'message' => 'No Coupon Found.'];
        }

    }

    public function Wishlisted_items(Request $request)
    {
        $query = Reaction::where(['type' => $request->type,'reference_type' => 'coupon',
            'user_id' => $request->user_id])
            ->join('coupons', 'reactions.reference_id', '=', 'coupons.id')
            ->select(
                'coupons.title',
                'coupons.slug',
                'coupons.category_id',
                'coupons.store_id',
                'coupons.regular_price',
                'coupons.affiliate_url',
                'coupons.compare_price',
                'coupons.id',
                'coupons.discount',
                'coupons.expiry_date',
                'coupons.country_id'
            );


//        $query = coupon::where('status', 1);

        if(isset($request->since_id)){
            $query = $query ->where('coupons.id','<',$request->since_id);
        }
        //Pagination
        if(isset($request->paginate)){
            $coupon = $query->orderBy('coupons.id', 'DESC')->paginate($request->paginate);
            $total=$coupon->total();
        }else{
            $coupon = $query->orderBy('coupons.id', 'DESC')->get();
            $total=count($coupon);
        }
        $coupon = $this->getCouponDetail($coupon,$total,$request);


        if ($coupon != null) {
            return $coupon;
        } else {
            return ['success' => false, 'message' => 'No Coupon Found.'];
        }


    }

    public function getCouponDetail($data,$total=null,$request=null)
    {
        // This is a Callback Function
        $coupon = [];
        foreach ($data as $row){
            if($request->user_id){
                $like = Reaction::where('reference_id',$row->id)->where('reference_type','coupon')
                    ->where('type','like')->where('user_id',$request->user_id)->get()->last();
                if($like){
                    $like =  true;
                }else{
                    $like=  false;
                }
                $wishlist = Reaction::where('reference_id',$row->id)->where('reference_type','coupon')
                    ->where('type','wishlist')->where('user_id',$request->user_id)->get()->last();
                if($wishlist){
                    $wishlist =  true;
                }else{
                    $wishlist=  false;
                }
            }else{
                $wishlist=  false;
                $like=  false;
            }

            $media  = media::where('reference_id',$row->id)->where('reference_type','coupon')->get()->first();
            $category  = categories::where('id',$row->category_id)->get()->first();
            $country  = country::where('id',$row->country_id)->get()->first();

            $store  = store::where('id',$row->store_id)->get();

            $coupon[] = [
                'coupon'=>$row,
                'country'=>$country,
                'total'=>$total,
                'single_coupon_url'=>url('single-coupons/'.$row->slug),
                'media'=>$media != null ? $media : [],
                'store'=>$store,
                'like'=>$like,
                'wishlist'=>$wishlist,
                'category'=>$category,
                'image_path'=>asset('images/media/'),
                'flag_url'=>asset('w80'),
            ];
        }

        return $coupon;
    }

    public function SingleCoupon(Request $request,$id)
    {
        // This is a Callback Function
        $coupon = [];
        $coupon = coupon::where('id', $id)->get()->first();
        $media  = media::where('reference_id',$id)->where('reference_type','coupon')->get();
        $category  = categories::where('id',$coupon->category_id)->get()->first();
        $country  = country::where('id',$coupon->country_id)->get()->first();

        if($request->user_id){
            $like = Reaction::where('reference_id',$id)->where('reference_type','coupon')
                ->where('type','like')->where('user_id',$request->user_id)->get()->last();
            if($like){
                $like =  true;
            }else{
                $like=  false;
            }
            $wishlist = Reaction::where('reference_id',$id)->where('reference_type','coupon')
                ->where('type','wishlist')->where('user_id',$request->user_id)->get()->last();
            if($wishlist){
                $wishlist =  true;
            }else{
                $wishlist=  false;
            }
        }else{
            $wishlist=  false;
            $like=  false;
        }


        $store  = store::where('id',$coupon->store_id)->get()->first();

        $data[] = [
            'coupon'=>$coupon,
            'country'=>$country,
            'like_count'=>4,

            'single_coupon_url'=>url('single-coupons/'.$coupon->slug),
            'media'=>$media,
            'store'=>$store,
            'category'=>$category,
            'like'=>$like,
            'wishlist'=>$wishlist,
            'image_path'=>asset('images/media/'),
            'flag_url'=>asset('flags'),
            'purchasing_instruction'=>'The descriptions and pictures of products on Discount Space are for reference only. Please fully view the product listing on Amazon before purchasing.',
        ];
        return $data;
    }

    public function AllVideo(Request $request)
    {
        $data = Videoshow::where('status','!=',1)
            ->where('id','>',isset($request->since_id) ? $request->since_id : 0)
            ->with('user');
        if(isset($request->paginate)) {
            $data = $data->paginate($request->paginate);
        }else{
            $data = $data->get();
        }
        $data = [
            'data'=>$data,
            'video_path'=>asset('/media/videos'),
            'thumbnail_path'=>asset('/media/videos/thumbnail'),
        ];
//        dd($data);
        return $data;
    }

    public function categories(Request $request){
        $query = categories::where('status', 1)
            ->where('id','>',isset($request->since_id) ? $request->since_id : 0);
        if(isset($request->type)){
            $query = $query->where('reference_type',$request->type);
        }
        if(isset($request->paginate)){
            $cat = $query->paginate($request->paginate);
        }else{
            $cat = $query->get();
        }
        $data=[
            'data'=>$cat,
            'image_path'=>asset('images/media'),
        ];
        return $data;
    }

    public function Blogs(Request $request){

        $query = blog::
        leftJoin('media', 'blogs.id', '=', 'media.reference_id')
            ->leftJoin('users', 'blogs.user_id', '=', 'users.id')
            ->where('reference_type','=','blog')
            ->where('blogs.id','>',isset($request->since_id) ? $request->since_id : 0)

            ->select('users.name as username ','blogs.id','blogs.title','blogs.short_description','blogs.category_id','blogs.updated_at','blogs.status','media.image');


        if(isset($request->paginate)){
            $query = $query->paginate($request->paginate);
        }else{
            $query = $query->get();
        }




        $data=[
            'data'=>$query,
            'image_path'=>asset('images/media'),
        ];
        return $data;
    }

    public function SingleBlog($id)
    {

        $category = blog::
        leftJoin('media', 'blogs.id', '=', 'media.reference_id')
            ->leftJoin('users', 'blogs.user_id', '=', 'users.id')
            ->where('reference_type','=','blog')
            ->where('blogs.id',$id)
            ->select('users.name as username','blogs.id','blogs.title','blogs.short_description','blogs.long_description','blogs.category_id','blogs.updated_at','blogs.status','media.image')
            ->get()->first();

        $data=[
            'data'=>$category,
            'image_path'=>asset('images/media'),
            'comments'=>6,
        ];
//dd($data);
        return $data;

    }

    public function Slider(){

        $slider = [];
        $data = Slider::leftJoin('media', function($join) {
            $join->on('sliders.id', '=', 'media.reference_id');
        })
            ->where('reference_type','=','slider')
            ->where('type','=','slider')
            ->select('sliders.id','sliders.url','sliders.type','sliders.orderby','sliders.status','sliders.slider','media.image')
            ->get();

        $slider = [
            'data' => $data,
            'image_path'=>asset('images/media'),
        ];

        return $slider;
    }

    public function PrivacyPolicy()
    {
        $data = [
            'description'=>'<p>Favorite Flyer values your online security. We were forced to use robust language to compose our privacy policy, in short, it says that we will never share or sell any information you provide to us. We encourage you to read it." then post the PP and have them accept.</p>',
            'title'=>'Privacy Policy',
        ];
        return $data;
    }

    public function ReactionPost(Request $request){

        $delete = Reaction::where('type',$request->type)
            ->where('reference_type',$request->reference_type)
            ->where('reference_id',$request->reference_id)
            ->where('user_id',$request->user_id)
            ->delete();
        $data = [
            'reference_type' => $request->reference_type,
            'reference_id' => $request->reference_id,
            'user_id' =>  $request->user_id,
            'type' => $request->type,
        ];
        $wow =  DB::table('reactions')->insert($data);
        if($wow){
            $like =  DB::table('reactions')
                ->where('type',$request->reaction)
                ->where('reference_type',$request->type)
                ->where('reference_id',$request->id)->get();
//                return  count($like);
            return ['count' => count($like), 'message' => 'Reaction Submitted successfully.'];

        }
    }

    public function ProfileSetting(Request $request)
    {
        $user = User::where('id',$request->user_id)->get()->first();
        if($user){
            $user->update(
                [
                    'name'=>$request->name,
                    'phone_number'=>$request->phone_number,
                ]
            );
            return ['success' => true, 'message' => 'Profile Updated Successfully.'];

        }else{
            return ['success' => false, 'message' => 'Something Went wrong.'];

        }
    }

    public function changePassword(Request $request)
    {
        if (Auth::attempt(['id' => $request->id, 'password' => $request->password])) {
            $user = User::find($request->id)->update(['password' => bcrypt($request->new_password)]);
            if ($user) {
                return ['success' => true, 'message' => 'Password updated succesfully.'];
            }
            return ['success' => false, 'message' => 'Password is not change.'];
        } else {
            return ['success' => false, 'message' => 'password is not correct'];
        }
    }


    public function DeactivateAccount(Request $request)
    {
        $user = User::where('id',$request->user_id)->get()->first();
        if($user){
            $user->update(
                [
                    'status'=>3,
                    'reason'=>$request->reason,
                ]
            );
            return ['success' => true, 'message' => 'Your Account has been Deactivated.'];

        }else{
            return ['success' => false, 'message' => 'Something Went wrong.'];

        }
    }

    public function Contact(Request $request)
    {
        Contact::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
            ]
        );
        return ['success' => true, 'message' => 'Your Query Has been submitted.'];
    }

    /** Auth API **/
    public function SignUp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return ['success' => false, 'message' => 'Validation Error'];
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'guard' => $request['guard'],
            'user_type' => 'user',
            'cookies' => $request['cookies'],
            'password' => Hash::make($request['password']),
        ]);

//        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success= $user;
        return ['success' => true,'data'=>$user, 'message' => 'User Registered successfully.'];

//        return $this->sendResponse($success, 'User Registered successfully.');

    }

    public function SignIn(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
//            $success['token'] = $user->createToken('MyApp')->accessToken;
            $data = $user;
            $wow =   User::where('id',$user->id)->get()->first();
//return $request['cookies'];
            $wow->update(
                [
                    'cookies' => $request['cookies'],
                ]
            );
//            return 'oo';
            return ['success' => true, 'data' => $data, 'message' => 'User login successfully.'];

//            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return ['success' => false, 'message' => 'Unauthorised'];
        }
    }


    public function EmailExist(Request $request)
    {
        $userCo = User::where('email', $request->email)->get();
        $userCount = count($userCo);

        if ($userCount == 1) {
            return ['success' => true, 'message' => 'Email already exists'];
        } else {
            return ['success' => false, 'message' => 'Email Not Found'];
        }
    }
    public function getUserByCookies(Request $request)
    {
        $userCo = User::where('cookies', $request['cookies'])->get();
        $userCount = count($userCo);

        if ($userCount == 1) {
            return ['success' => true,'data'=>$userCo];
        } else {
            return ['success' => false];
        }
    }
    public function getSavedItemByCookies(Request $request)
    {
        $userCo = User::where('cookies', $request['cookies'])->get()->first();
        if($userCo){
            $reaction = Reaction::where('reference_type','coupon')->where('user_id',$userCo->id)->where('type','save')->get();
            $coupon = [];
            foreach ($reaction as $row){
                $wwww= coupon::where('id',$row->reference_id)->get()->first();
                $media  = media::where('reference_id',$row->reference_id)->where('reference_type','coupon')->get();
                $category  = categories::where('id',$wwww->category_id)->get()->first();
                $store  = store::where('id',$row->store_id)->get();
                $coupon[] = [
                    'coupon'=>$wwww,
                    'single_coupon_url'=>url('single-coupons/'.$wwww->slug),
                    'media'=>$media,
                    'store'=>$store,
                    'category'=>$category,
                    'image_path'=>asset('images/media/'),
                ];
            }
//        dd($coupon);
            return $coupon;
        }else{
            return false;

        }

    }
    
}
