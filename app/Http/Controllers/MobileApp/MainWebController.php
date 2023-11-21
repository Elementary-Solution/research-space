<?php

namespace App\Http\Controllers\MobileApp;
// use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Subscription;
use App\Models\country;
use App\Models\Settings;
use App\Models\InquireNow;
use App\Models\Order;
use App\Models\Paper;
use App\Models\OrderConfig;
use App\Models\Reaction;
use App\Models\store;
use App\Models\Contact;
use App\Models\Redirect_History;
use App\Models\Applied_History;
use App\Models\coupon;
use App\Models\CouponDiscount;
use App\Models\Newsletter;
use App\Models\media;
use App\Models\Slider;
use App\Models\Files;
use App\Models\blog;
use App\Models\Keyword;
use App\Models\Goal;
use App\Models\Videoshow;
use App\Models\shipmentDetails;
use App\Models\FileTitle;
use App\Models\Payment;
use App\Models\DownloadHistory;
use App\Models\CreateOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\OrderSettings\AcademicLevel\AcademicLevel;
use App\Models\OrderSettings\Citation_Style\Citation_Style;
use App\Models\OrderSettings\DocumentType\DocumentType;
use App\Models\OrderSettings\LanguageStyle\LanguageStyle;
use App\Models\OrderSettings\PaperFormat\PaperFormat;
use App\Models\OrderSettings\PaperType\PaperType;
use App\Models\OrderSettings\SubjectType\SubjectType;
use App\Models\User;
use http\Url;
use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;

class MainWebController extends Controller
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


    public function manageStatus(Request $request)
    {

        $data = CreateOrder::where('id', $request->id)->get()->first();

        $data->update([
            'erp_status'=>$request->status
        ]);

        return $data;
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



//    public function AllCoupons(Request $request)
//    {
//        // dd($request);
//
//
//        $coun = 226;
//        $query = coupon::where('status', 1);
//
//        if(isset($request->since_id)){
//            $query = $query ->where('id','<',$request->since_id);
//        }
//        if(isset($request->category_id)){
//            $query = $query->where('category_id',(int)$request->category_id);
//        }
//        if(isset($request->category_ids)){
//            $category_ids = json_decode($request->category_ids, true);
//
//            $query = $query->whereIn('category_id',$category_ids);
//        }
//        if(isset($request->category_slug)){
//
//
//            $category  = categories::where('slug',$request->category_slug)->get()->first();
//
//
//            $query = $query->where('category_id',$category->id);
//        }
//        if(isset($request->search)){
//            $query = $query->where('title', 'like', "%$request->search%");
//        }
//        if (isset($request->store_id)){
//            $query = $query->where('store_id',$request->store_id);
//        }
//        if (isset($request->type)){
//            $query = $query->where('coupon_type',$request->type);
//        }
//        if (isset($request->graph)){
//            $query = $query->whereJsonContains('coupon_graph',$request->graph);
//        }
//        if(isset($request->discount) != null && $request->discount != 'all' ){
//            $serial = (unserialize($request->discount));
//            $query->whereBetween('discount', [$serial['min'], $serial['max']]);
//        }
//        if(isset($request->sort) != null)
//        {
//            if($request->sort == '0'){
//                $query->orderBy('id', 'asc');
//            }
//            elseif($request->sort == '1') {
//                $query->orderBy('regular_price', 'asc');
//            }
//            elseif($request->sort == '2'){
//                $query->orderBy('regular_price', 'desc');
//            }
//            else
//            {
//                $query->orderBy('id', 'desc');
//            }
//        }
//
//
//
//        $query = $query->select(
//            'coupons.title',
//            'coupons.category_id',
//            'coupons.store_id',
//            'coupons.slug',
//            'coupons.regular_price',
//            'coupons.affiliate_url',
//            'coupons.compare_price',
//            'coupons.id',
//            'coupons.coupon_type',
//            'coupons.discount',
////            'coupons.expiry_date',
//            'coupons.country_id'
//        );
//        //Pagination
//        if(isset($request->paginate)){
//            $coupon = $query->orderBy('id', 'DESC')->paginate($request->paginate);
//            $total=$coupon->total();
//        }else{
//            $coupon = $query->orderBy('id', 'DESC')->get();
//            $total=count($coupon);
//        }
//        $coupon = $this->getCouponDetail($coupon,$total,$request);
//
//
//
//        if ($coupon != null) {
//            return $coupon;
//
//        } else {
//            return [];
////            return ['success' => false, 'message' => 'No Coupon Found.'];
//        }
//
//    }
//
//    public function Wishlisted_items(Request $request)
//    {
//        $user = User::where('user_token',$request->user_token)->get()->first();
//        $query = Reaction::where(['type' => $request->type,'reference_type' => 'coupon',
//            'user_id' => $user->id])
//            ->join('coupons', 'reactions.reference_id', '=', 'coupons.id')
//            ->select(
//                'coupons.title',
//                'coupons.slug',
//                'coupons.category_id',
//                'coupons.store_id',
//                'coupons.regular_price',
//                'coupons.affiliate_url',
//                'coupons.compare_price',
//                'coupons.id',
//                'coupons.discount',
//                'coupons.expiry_date',
//                'coupons.country_id'
//            );
//
//
////        $query = coupon::where('status', 1);
//        if(isset($request->search)){
//            $query = $query ->where('coupons.title', 'like', "%$request->search%");
//        }
//        if(isset($request->since_id)){
//            $query = $query ->where('coupons.id','<',$request->since_id);
//        }
//        //Pagination
//        if(isset($request->paginate)){
//            $coupon = $query->orderBy('coupons.id', 'DESC')->paginate($request->paginate);
//            $total=$coupon->total();
//        }else{
//            $coupon = $query->orderBy('coupons.id', 'DESC')->get();
//            $total=count($coupon);
//        }
//        $coupon = $this->getCouponDetail($coupon,$total,$request);
//
//
//        if ($coupon != null) {
//            return $coupon;
//        } else {
//            return ['success' => false, 'message' => 'No Coupon Found.'];
//        }
//
//
//    }
//
//    public function Keywords(){
//        $data = Keyword::select('title as value')->get();
//        return $data;
//    }
//
//
//    public function setGoals(Request $req){
//
//        // return $req;
//        $msg = '';
//        $user = User::where('user_token',$req->user_id)->get()->first();
//        // return $user;
//        $goal = Goal::where('user_id',$user->id)->get()->first();
//
//        if($goal){
//            $goal->update(   [
//                'keywords'=>json_encode($req->values),
//            ]);
//            $msg = 'Goals Updated Successfully.';
//        }
//        else{
//
//            Goal::create(
//                [
//                'user_id'=>$user->id,
//                'keywords'=>json_encode($req->values),
//                ]
//            );
//            $msg = 'Goals Added Successfully.';
//    }
//        return ['success' => true, 'message' => $msg];
//
//        // $data = Keyword::select('title as value')->get();
//        // return $data;
//    }
//
//    public function getGoals(Request $request){
//        $user = User::where('user_token',$request->user_token)->get()->first();
//
//        $data = Goal::where('user_id', $user->id)->select('keywords')->get();
//
//        // return $data;
//        if (count($data)) {
//            return $data;
//        }
//        else{
//
//            $dataaf[] = [
//                'keywords' => "[]"
//            ];
//
//            return $dataaf;
//        }
//
//    }
//
//    public function redirectHistory(Request $request){
//
//        $user = User::where('user_token',$request->user_token)->get()->first();
//
//        $res = Redirect_History::create([
//            'domain' => $request->domain,
//            'product_id' => $request->product_id,
//            'user_id' => $user->id,
//            'guard' => $request->guard,
//        ]);
//
//
//        if ($res) {
//            return ['success' => true];
//        } else {
//            return ['success' => false];
//        }
//    }
//
    public function appliedHistory(Request $request){

        $user = User::where('user_token',$request->user_token)->get()->first();

        $res = Applied_History::create([
            'domain' => $request->domain,
            'product_id' => $request->product_id,
            'user_id' => $user->id,
            'guard' => $request->guard,
        ]);


        if ($res) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function loginWithSocial(Request $request){

        if ($request->type === 'facebook') {

            $data =   User::where('email',$request->credentials['email'])->get()->first();

            if ($data) {
                return ['success' => true, 'data' => $data, 'message' => 'User login successfully.'];
            } else {
                return ['success' => false, 'message' => 'Sorry! Your account doe\'st exist!'];
            }

        }
        else{
            // $credential = $request->credentials;
            // $tokenParts = explode(".", $credential);
            // $tokenPayload = base64_decode($tokenParts[1]);
            // $jwtPayload = json_decode($tokenPayload);


            $data =   User::where('email',$request->credentials['email'])->get()->first();


            if ($data) {
                return ['success' => true, 'data' => $data, 'message' => 'User login successfully.'];
            } else {
                return ['success' => false, 'message' => 'Sorry! Your account doe\'st exist!'];
            }
        }


    }

    public function signupWithSocial(Request $request){


        if ($request->type === 'facebook') {

            $already = User::where('email',$request->credentials['email'])->get()->first();
            if($already != null){
                return ['success' => false, 'message' => 'Email already exist'];
            }

            $user = User::create([
                'domain' => $request->domain,
                'name' => $request->credentials['name'],
                'email' => $request->credentials['email'],
                'user_type' => 'user',
                'guard' => 'web',
                'type' => $request->type,
                'password' => time().rand(100000000,1000000000000).date("Ymd"),

                'user_token' => time().rand(100000000,1000000000000).date("Ymd"),
            ]);

            $dat = User::where('id',$user->id)->first();
            return ['success' => true,'data'=>$dat, 'message' => 'User Registered successfully.'];

        }
        else
        {
            // $credential = $request->credentials;
            // $tokenParts = explode(".", $credential);
            // $tokenPayload = base64_decode($tokenParts[1]);
            // $jwtPayload = json_decode($tokenPayload);
            // return $request->type;
            // $user = User::where('user_token',$request->user_token)->get()->first();

            $already = User::where('email',$request->credentials['email'])->get()->first();
            if($already != null){
                return ['success' => false, 'message' => 'Email already exist'];
            }

            $user = User::create([
                'domain' => $request->domain,
                'name' => $request->credentials['name'],
                'email' => $request->credentials['email'],
                'user_type' => 'user',
                'guard' => 'web',
                'type' => $request->type,
                'user_token' => time().rand(100000000,1000000000000).date("Ymd"),
            ]);

            $dat = User::where('id',$user->id)->first();
            return ['success' => true,'data'=>$dat, 'message' => 'User Registered successfully.'];}
        // $data = Goal::where('user_id', $user->id)->select('keywords')->get();

        // return $user;
    }

//    public function getCouponDetail($data,$total=null,$request=null)
//    {
//        // This is a Callback Function
//        $coupon = [];
//        foreach ($data as $row){
//            if($request->user_id){
//                $like = Reaction::where('reference_id',$row->id)->where('reference_type','coupon')
//                    ->where('type','like')->where('user_id',$request->user_id)->get()->last();
//                if($like){
//                    $like =  true;
//                }else{
//                    $like=  false;
//                }
//                $wishlist = Reaction::where('reference_id',$row->id)->where('reference_type','coupon')
//                    ->where('type','wishlist')->where('user_id',$request->user_id)->get()->last();
//                if($wishlist){
//                    $wishlist =  true;
//                }else{
//                    $wishlist=  false;
//                }
//
//
//                $save = Reaction::where('reference_id',$row->id)->where('reference_type','coupon')
//                    ->where('type','save')->where('user_id',$request->user_id)->get()->last();
//                if($save){
//                    $save =  true;
//                }else{
//                    $save=  false;
//                }
//            }else{
//                $wishlist=  false;
//                $like=  false;
//                $save=  false;
//            }
//
//            $media  = media::where('reference_id',$row->id)->where('reference_type','coupon')->get()->first();
//            $category  = categories::where('id',$row->category_id)->get()->first();
//            $country  = country::where('id',$row->country_id)->get()->first();
//
//            $store  = store::where('id',$row->store_id)->get();
//
//            $coupon[] = [
//                'coupon'=>$row,
//                'country'=>$country,
//                'total'=>$total,
//                'single_coupon_url'=>url('single-coupons/'.$row->slug),
//                'media'=>$media != null ? $media : [],
//                'store'=>$store,
//                'save'=>$save,
//                'like'=>$like,
//                'wishlist'=>$wishlist,
//                'category'=>$category,
//                'image_path'=>asset('images/media/'),
//                'flag_url'=>asset('w80'),
//            ];
//        }
//
//        return $coupon;
//    }


    //
//    public function SingleCoupon(Request $request,$id)
//    {
//        // This is a Callback Function
//        $coupon = [];
//        $coupon = coupon::where('slug', $id)->get()->first();
//        $media  = media::where('reference_id',$coupon->id)->where('reference_type','coupon')->get();
//        $category  = categories::where('id',$coupon->category_id)->get()->first();
//        $country  = country::where('id',$coupon->country_id)->get()->first();
//
//        if($request->user_id){
//            $like = Reaction::where('reference_id',$id)->where('reference_type','coupon')
//                ->where('type','like')->where('user_id',$request->user_id)->get()->last();
//            if($like){
//                $like =  true;
//            }else{
//                $like=  false;
//            }
//            $wishlist = Reaction::where('reference_id',$id)->where('reference_type','coupon')
//                ->where('type','wishlist')->where('user_id',$request->user_id)->get()->last();
//            if($wishlist){
//                $wishlist =  true;
//            }else{
//                $wishlist=  false;
//            }
//        }else{
//            $wishlist=  false;
//            $like=  false;
//        }
//
//
//        $store  = store::where('id',$coupon->store_id)->get()->first();
//
//        $data[] = [
//            'coupon'=>$coupon,
//            'country'=>$country,
//            'like_count'=>4,
//
//            'single_coupon_url'=>url('single-coupons/'.$coupon->slug),
//            'media'=>$media,
//            'store'=>$store,
//            'category'=>$category,
//            'like'=>$like,
//            'wishlist'=>$wishlist,
//            'image_path'=>asset('images/media/'),
//            'flag_url'=>asset('flags'),
//            'purchasing_instruction'=>'The descriptions and pictures of products on Discount Space are for reference only. Please fully view the product listing on Amazon before purchasing.',
//        ];
//        return $data;
//    }
//
//    public function AllVideo(Request $request)
//    {
//        $data = Videoshow::where('status',1)
//            ->where('id','>',isset($request->since_id) ? $request->since_id : 0)
//            ->with('user');
//        if(isset($request->paginate)) {
//            $data = $data->paginate($request->paginate);
//        }else{
//            $data = $data->get();
//        }
//        $data = [
//            'data'=>$data,
//            'video_path'=>asset('/media/videos'),
//            'thumbnail_path'=>asset('/media/videos/thumbnail'),
//        ];
////        dd($data);
//        return $data;
//    }

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

            ->select('users.name as username ','blogs.id','blogs.slug','blogs.title','blogs.short_description','blogs.category_id','blogs.updated_at','blogs.status','media.image');


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
            ->where('blogs.slug',$id)
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

//    public function SingleVideo($slug)
//    {
//
//
//        $data = Videoshow::where('status','=',1)->where('slug',$slug)->get()->first();
//
//        $data = [
//            'data'=>$data,
//            'video_path'=>asset('/media/videos'),
//            'thumbnail_path'=>asset('/media/videos/thumbnail'),
//        ];
////        dd($data);
//        return $data;
//
//    }

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
        $user = User::where('user_token',$request->user_token)->get()->first();
        $react = Reaction::where('type',$request->type)
            ->where('reference_type',$request->reference_type)
            ->where('reference_id',$request->reference_id)
            ->where('user_id',$user->id)
            ->get();
        if(count($react) == 0 ) {
            $data = [
                'reference_type' => $request->reference_type,
                'reference_id' => $request->reference_id,
                'user_id' => $user->id,
                'type' => $request->type,
                'comments' => $request->comment,
            ];
            $wow = DB::table('reactions')->insert($data);
            if ($wow) {
                $like = DB::table('reactions')
                    ->where('type', $request->reaction)
                    ->where('reference_type', $request->type)
                    ->where('reference_id', $request->id)->get();
                return ['count' => count($like), 'message' => 'Reaction Submitted successfully.', 'success' => true];
            }
        }else{
            $react->each->delete();
            return ['message' => 'Reaction Submitted .', 'success' => false];
        }
    }


    public function ProfileSetting(Request $request)
    {
        $user =  User::where('user_token',$request->token)->get()->first();
        if($user){
            $user->update(
                [
                    'name'=>$request->name,
                    'phone_number'=>$request->phone_number,
                ]
            );

            return ['success' => true, 'data' => $user, 'message' => 'Profile Updated Successfully.'];

        }else{
            return ['success' => false, 'message' => 'Something Went wrong.'];

        }
    }


    public function ChangePassword(Request $request)
    {

        $u =  User::where('user_token',$request->token)->get()->first();
        if (Auth::attempt(['id' => $u->id, 'password' => $request->password])) {
            $user = User::find($u->id)->update(['password' => bcrypt($request->new_password)]);
            if ($user) {
                return ['success' => true, 'message' => 'Your password updated successfully.'];
            }
            return ['success' => false, 'message' => 'Password is not change.'];
        } else {
            return ['success' => false, 'message' => 'Your current password is invalid'];
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
                'product_id'=>$request->product_id,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
                'guard'=>'Web',
                'domain'=>$request->domain,
            ]
        );
        return ['success' => true, 'message' => 'Your Query Has been submitted.'];
    }

    /** Auth API **/
    public function SignUp(Request $request)
    {

        $already = User::where('email',$request->email)->get()->first();
        if($already != null){
            return ['success' => false, 'message' => 'Email already exist'];
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'message' => 'Validation Error'];
        }

        $user = User::create([
            'domain' => $request['domain'],
            'name' => $request['name'],
            'email' => $request['email'],
            'user_type' => 'user',
            'guard' => 'web',
            'user_token' => time().rand(100000000,1000000000000).date("Ymd"),
            'password' => Hash::make($request['password']),
        ]);
        $dat = User::where('id',$user->id)->first();
        return ['success' => true,'data'=>$dat, 'message' => 'User Registered successfully.'];
    }

    public function SignIn(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data = $user;
            $wow =   User::where('id',$user->id)->get()->first();
            $wow->update(
                [
                    'cookies' => $request['cookies'],
                ]
            );
            return ['success' => true, 'data' => $data, 'message' => 'User login successfully.'];
        } else {
            return ['success' => false, 'message' => 'Sorry! Your account doesn\'t exist!'];
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





    public function NewsletterSubscribe(Request $request)
    {
        $already = Newsletter::where('email',$request->email)->get()->first();
        if($already == null){


            Newsletter::create(
                [
                    'email'=>$request->email,
                    'user_id'=>$request->user_id
                ]
            );
            return ['success'=>true, 'message'=>'Thank you for subscribing.' ];
        }else{
            return ['success'=>false, 'message'=>'You already subscribe.' ];

        }
    }

    public function discountSubscription(Request $request)
    {
        $subscription = [];
        $query = Subscription::leftJoin('media', 'subscriptions.id', '=', 'media.reference_id')
            ->leftJoin('users', 'subscriptions.user_id', '=', 'users.id')
            ->where('media.reference_type','=','subscription');




        if($request->has('type') && $request->type != null){
            $query = $query->where('subscriptions.permission',$request->type);
        }
        $query = $query->select('subscriptions.id','subscriptions.permission','subscriptions.slug','subscriptions.title','subscriptions.minimum_pages_allowed','subscriptions.actual_price_per_page','subscriptions.compare_price_per_page','subscriptions.maximum_pages_allowed','subscriptions.actual_price','subscriptions.compare_price','subscriptions.description','subscriptions.no_of_pages','subscriptions.subscription_duration','subscriptions.category_id','subscriptions.updated_at','subscriptions.status','media.image')
            ->get();


        $subscription=[
            'data'=>$query,
            'image_path'=>asset('images/media'),
        ];
        return $subscription;
    }

    public function singleCustomOrder(Request $request){

        $query = CreateOrder::where('create_orders.id',$request->slug)->get();


        if($query){

            return ['success'=>true, 'data'=>$query, 'message'=>'Thank you for subscribing.' ];
        }else{
            return ['success'=>false, 'message'=>'You already subscribe.' ];

        }

    }


    public function singleSubscription(Request $request)
    {
        $singleSubscription = [];
        $query = Subscription::leftJoin('media', 'subscriptions.id', '=', 'media.reference_id')
            ->where('subscriptions.slug',$request->slug)
            ->where('media.reference_type','=','subscription')
            ->select('subscriptions.id','subscriptions.permission','subscriptions.slug','subscriptions.title','subscriptions.actual_price','subscriptions.compare_price'  ,'subscriptions.description','subscriptions.no_of_pages','subscriptions.subscription_duration','subscriptions.compare_price_per_page','subscriptions.actual_price_per_page','subscriptions.category_id' ,'subscriptions.minimum_pages_allowed' ,'subscriptions.maximum_pages_allowed','media.image')


            ->get()->first();
        $singleSubscription=[
            'data'=>$query,
            'image_path'=>asset('images/media'),
        ];
        return $singleSubscription;
    }

    public function viewSubscription (Request $req) {

        $singleSubscription = [];
        $query = Subscription::leftJoin('media', 'subscriptions.id', '=', 'media.reference_id')
            ->where('subscriptions.slug',$req->slug)
            ->where('media.reference_type','=','subscription')
            ->select('subscriptions.id','subscriptions.permission','subscriptions.slug','subscriptions.title'  ,'subscriptions.description','subscriptions.no_of_pages','subscriptions.subscription_duration','subscriptions.compare_price_per_page','subscriptions.actual_price_per_page','subscriptions.category_id' ,'subscriptions.minimum_pages_allowed' ,'subscriptions.maximum_pages_allowed','media.image','subscriptions.actual_price','subscriptions.compare_price')
            ->get()->first();

        $singleSubscription=[
            'data'=>$query,
            'image_path'=>asset('images/media'),
        ];

        return $singleSubscription;

    }

    public function postOrder(Request $request)
    {
        $user = User::where('user_token',$request->user_token)->get()->first();
        $query = $request->discount_code ? CouponDiscount::where('discount_code',$request->discount_code)->get()->last()->pluck('id') :null;
//return $user->id;
        $order=Order::create(
            [
                'user_id'=>$user->id,
                'variation_id'=>$request->variation_id,
                'currency_id'=>$request->currency_id,
                'subscription_id'=>$request->subscription_id,
                'subscription_duration'=>$request->subscription_duration,
                'discount_id'=>$query,
                'no_of_pages'=>$request->no_of_pages,
                'order_status'=>$request->order_status,
                'grand_total'=>$request->grand_total,
                'coupon_discount'=>$request->coupon_discount,
                'order_total'=>$request->order_total,
                'is_custom_order'=>$request->is_custom_order?$request->is_custom_order:null,
                'custom_order_id'=>$request->custom_order_id?$request->custom_order_id:null,
            ]
        );
//return $order;
        shipmentDetails::create(
            [
                'user_id'=>$user->id,
                'order_id'=>$order->id,
                'billing_first_name'=>$request->first_name,
                'billing_last_name'=>$request->last_name,
                'billing_country'=>$request->country,
                'billing_zip_code'=>$request->zip_code,
                'billing_street_address'=>$request->street_address,
                'billing_apartment_detail'=>$request->apartment_detail,
                'billing_email'=>$request->email,
                'billing_city'=>$request->city,
                'billing_state'=>$request->state,
                'billing_phone'=>$request->phone,
            ]
        );
        Payment::create(
            [
                'user_id'=>$user->id,
                'payment_id'=>$request->payment_id,
                'payment_link'=>$request->payment_link,
                'order_id'=>$order->id,
                'payment_status'=>$request->payment_status,
                'payment_duration'=>$request->payment_duration,
            ]
        );



        if($request->custom_order_id){
            CreateOrder::where('id', $request->custom_order_id)
                ->update([
                    'is_paid' => 1
                ]);


            //    where::update('update student set name = ? where id = ?',[$name,$id]);;
            //    $updated->is_paid->update

            //  $dda =  update([
            //     $updated->is_paid=1
            //    ]);
            //    return  $updated;
            //    ->update('create_orders.is_paid', 1)
        }




        return ['success' => true, 'message' => 'Your Order Has been inserted successfully.'];
    }

    public function getOrder(Request $request)
    {
        $user = User::where('user_token',$request->user_token)->get()->first();
        $shipmentDetails = shipmentDetails::where('user_id',$user->id)->get();
        $order = Order::leftJoin('subscriptions', 'subscriptions.id', '=', 'orders.subscription_id')
            ->leftJoin('create_orders', 'create_orders.id', '=', 'orders.custom_order_id')
            ->where('orders.user_id',$user->id)
            ->select('orders.user_id','orders.id','orders.discount_id','create_orders.erp_academic_name AS custom_title','create_orders.id AS custom_slug','create_orders.erp_deadline AS custom_duration', 'orders.no_of_pages','orders.order_status','orders.grand_total','orders.coupon_discount','orders.order_total','subscriptions.title','subscriptions.slug','subscriptions.subscription_duration','subscriptions.actual_price','subscriptions.compare_price','subscriptions.stock')->get();


        if($order && $shipmentDetails)
        {
            return ['success'=>true,  'order'=>$order,'shipmentDetails'=>$shipmentDetails,'message' => 'Your Order Has been inserted successfully.'];
        }else{
            return ['success'=>false, 'message'=>'Something Went Wrong.' ];

        }
    }

    public function singleOrder(Request $request)
    {
        $order = '';

        if($request->slug){
            $order = Order::leftjoin('subscriptions','subscriptions.id','=','orders.subscription_id')
                ->leftjoin('users','users.id','=','orders.user_id')
                ->leftjoin('shipment_details','orders.id','=','shipment_details.order_id')
                ->where('subscriptions.slug',$request->slug)
                ->select('shipment_details.billing_email','orders.id','subscriptions.title','orders.order_total','shipment_details.billing_email','shipment_details.billing_street_address','shipment_details.billing_first_name','shipment_details.billing_last_name','shipment_details.billing_phone','shipment_details.billing_country','shipment_details.billing_city','orders.user_id','orders.discount_id','orders.no_of_pages','orders.order_status','orders.grand_total','orders.coupon_discount','orders.order_total','subscriptions.title','subscriptions.slug','subscriptions.subscription_duration','subscriptions.actual_price','subscriptions.compare_price','subscriptions.stock')->get()->first();
        }
        else{
            $order = Order::leftJoin('create_orders', 'create_orders.id', '=', 'orders.custom_order_id')
                ->leftjoin('users','users.id','=','orders.user_id')
                ->leftjoin('shipment_details','orders.id','=','shipment_details.order_id')
                ->where('create_orders.id',$request->id)
                ->select('shipment_details.billing_email','orders.id','orders.order_total','shipment_details.billing_email','create_orders.erp_deadline AS custom_duration','shipment_details.billing_street_address','shipment_details.billing_first_name','shipment_details.billing_last_name','shipment_details.billing_phone','shipment_details.billing_country','shipment_details.billing_city','orders.user_id','orders.discount_id','orders.no_of_pages','create_orders.erp_academic_name AS custom_title','orders.order_status','orders.grand_total','orders.coupon_discount','orders.order_total')->get()->first();
        }

        if($request->slug){

        };
        if($order)
        {
            return ['success'=>true,  'order'=>$order,'message' => 'Your Order Has been inserted successfully.'];
        }else{
            return ['success'=>false, 'message'=>'Something Went Wrong.' ];

        }

    }

    public function Paper(Request $request)
    {
        $paper = [];
        $query = Paper::select('category_id','id','title','slug','summary','status','created_at','updated_at');

        if($request->has('type') && $request->type !=  null ){
            $query =   $query->where('type',$request->type);
        }

        $query  =  $query->get();
        $paper=[
            'data'=>$query,
        ];
        return $paper;
    }

    public function singlePaper(Request $request)
    {
        $singlepaper = [];
        $query = Paper::where('slug',$request->slug)->get()->first();
        $singlepaper=[
            'data'=>$query,
        ];
        return $singlepaper;
    }

    public function postPaper(Request $request)
    {
        $query = Paper::where('slug',$request->slug)->get()->first();
        $user = User::where('user_token',$request->user_token)->get()->first();

        if($query->type == 0){
            DownloadHistory::create(
                [
                    'user_id'=>$user != null ? $user->id : '',
                    'subscription_id'=>null,
                    'type'=>$request->type,
                ]
            );

            $paper=[
                'data'=>$query,
                'file_path'=>asset('document/file'),
            ];
            return ['success'=>true,  'data'=>$paper['data'],'file_path'=>$paper['file_path']];;
        }

        $download = DownloadHistory::where('user_id',$user->id)->where('type',null)->get();



        $order = Order::leftJoin('subscriptions', 'subscriptions.id', '=', 'orders.subscription_id')
            ->where('orders.user_id',$user->id)
            ->select( 'subscriptions.permission' )->pluck('subscriptions.permission')->toArray();






        if(in_array('past-paper',$order)) {

            DownloadHistory::create(
                [
                    'user_id'=>$user->id,
                    'subscription_id'=>null,
                    'type'=>1,
                ]
            );

            $paper=[
                'data'=>$query,
                'file_path'=>asset('document/file'),
            ];
            return ['success'=>true,  'data'=>$paper['data'],'file_path'=>$paper['file_path']];;

        }else{

            if(count($download) >= 1){
                return ['success'=>false, 'message'=>'Your Free limit is expire.'];
            }
            else{
                DownloadHistory::create(
                    [
                        'user_id'=>$user->id,
                        'subscription_id'=>null,
                        'type'=>$request->type,
                    ]
                );

                $paper=[
                    'data'=>$query,
                    'file_path'=>asset('document/file'),
                ];
                return ['success'=>true,  'data'=>$paper['data'],'file_path'=>$paper['file_path']];;
            }
        }

    }

    public function couponDiscount(Request $request)
    {
        $couponDiscount = [];
        $user = User::where('user_token',$request->user_token)->get()->first();
        $query = CouponDiscount::where('discount_code',$request->discount_code)->get()->last();


        if($query)
        {
            $code = Order::where('user_id',$user->id)->where('discount_id',$query->id)->get()->first();

            if($code)
            {
                return ['success'=>false, 'message'=>'Already Applied for Discount Code.'];
            }
            else{
                $couponDiscount=[
                    'data'=>$query,
                ];
                return ['success'=>true,  'data'=>$couponDiscount['data'], 'message' => 'Your Discount Code is Verified.'];
            }
        }
        else
        {
            return ['success'=>false, 'message'=>'Discount code doesn\'t exist.'];
        }

    }
    public function orderConfig( )
    {
        $query = OrderConfig::get();


        if($query)
        {
            return ['success'=>true,  'data'=>$query, 'message' => 'Your Discount Code is Verified.'];

        }
        else
        {
            return ['success'=>false, 'message'=>'Discount code doesn\'t exist.'];
        }

    }

    public function inquireNow(Request $request)
    {
        InquireNow::create(
            [
                'product_id'=>$request->product_id,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'message'=>$request->message,
            ]
        );
        return ['success' => true, 'message' => 'Inquire Now Has been inserted successfully.'];
    }





    public function userPermissions(Request $request){
        $user = User::where('user_token',$request->user_token)->get()->first();


        $order = Order::leftJoin('subscriptions', 'subscriptions.id', '=', 'orders.subscription_id')
            ->where('orders.user_id',$user->id)
            ->select( 'subscriptions.permission' )->pluck('subscriptions.permission')->toArray();


        return $order;

    }

    public function getOrderSettings(){

        $academic_level_data = AcademicLevel::get();
        $citation_style_data = Citation_Style::get();
        $document_type_data = DocumentType::get();
        $language_style_data = LanguageStyle::get();
        $paper_format_data = PaperFormat::get();
        $paper_type_data = PaperType::get();
        $subject_type_data = SubjectType::get();
        $ddline = OrderConfig::get()->first();

        $academic_level = [];
        $citation_style = [];
        $document_type = [];
        $language_style = [];
        $paper_format = [];
        $paper_type = [];
        $subject_type = [];
        $deadline = [];



        foreach ($academic_level_data as $key => $value) {

            array_push($academic_level, (object)[
                'label' => $value->erp_academic_name,
                'value' => $value->erp_academic_name,
            ]);

        };
        foreach ($citation_style_data as $key => $value) {

            array_push($citation_style, (object)[
                'label' => $value->erp_title,
                'value' => $value->id,
            ]);

        };
        foreach ($document_type_data as $key => $value) {

            array_push($document_type, (object)[
                'label' => $value->erp_document_title,
                'value' => $value->id,
            ]);

        };
        foreach ($language_style_data as $key => $value) {

            array_push($language_style, (object)[
                'label' => $value->erp_language_name,
                'value' => $value->erp_language_name,
            ]);

        };
        foreach ($paper_format_data as $key => $value) {

            array_push($paper_format, (object)[
                'label' => $value->erp_paper_format,
                'value' => $value->id,
            ]);

        };
        foreach ($paper_type_data as $key => $value) {

            array_push($paper_type, (object)[
                'label' => $value->erp_paper_type,
                'value' => $value->id,
            ]);

        };
        foreach ($subject_type_data as $key => $value) {

            array_push($subject_type, (object)[
                'label' => $value->erp_subject_name,
                'value' => $value->erp_subject_name,
            ]);

        };


        // $deadline = [
        //    0 => ['value'=> 'erp_eight_hrs', 'label'=> '8 hours', 'minimum_price_per_page'=>9 ],
        //    1 => ['value'=> 'erp_tf_hrs', 'label'=> '24 hours', 'minimum_price_per_page'=>8 ],
        //    2 => ['value'=> 'erp_fe_hrs', 'label'=> '48 hours', 'minimum_price_per_page'=>7 ],
        //    3 => ['value'=> 'erp_three_days', 'label'=> '3 days', 'minimum_price_per_page'=>6 ],
        //    4 => ['value'=> 'erp_five_days', 'label'=> '5 days', 'minimum_price_per_page'=>5 ],
        //    5 => ['value'=> 'erp_seven_days', 'label'=> '7 days', 'minimum_price_per_page'=>4 ],
        //    6 => ['value'=> 'erp_fourteen_days', 'label'=> '14 days', 'minimum_price_per_page'=>3 ],
        //    7  => ['value'=> 'erp_fourteen_plus_days', 'label'=> '14+ days', 'minimum_price_per_page'=>2 ],
        // ];

        $deadline = json_decode($ddline->min_max);

        $data =   [
            'academic_level'=>$academic_level,
            'citation_style'=>$citation_style,
            'document_type'=>$document_type,
            'language_style'=>$language_style,
            'paper_format'=>$paper_format,
            'paper_type'=>$paper_type,
            'subject_type'=>$subject_type,
            'deadline'=>$deadline
        ];

        return $data;
    }

    public function manageConfig(Request $request)
    {


        $data = OrderConfig::get()->first();

        $val = json_decode($data->min_max);

        foreach ($val as $key => $value) {
            if($value->value === $request->order_json){
                $value->maximum_price_per_page=$request->max_price;
                $value->minimum_price_per_page=$request->min_price;
            }
        }

        $dta = $data->update([

            'maximum_price_per_page'=>$request->max_page_page_price,
            'minimum_price_per_page'=>$request->min_page_page_price,
            'minimum_pages_allowed'=>$request->min_pages,
            'maximum_pages_allowed'=>$request->max_pages,
            'min_max'=>json_encode($val)

        ]);


        if($dta){
            return ['success' => true, 'message' => 'Updated Successfully.'];
        }else{
            return ['success' => false, 'message' => 'No Coupon Found.'];
        }



    }


    public function create_orders(Request $request){


        $user = User::where('user_token',$request->erp_user_id)->get()->first();

        $file = '';


        // if ($request->erp_resource_file) {
        //  $file=   Storage::disk('public_uploads')->put('/uploads/files/'.$request->erp_resource_file->getClientOriginalName(), $request->erp_resource_file);


        //  $file = Storage::disk('public_uploads')->put('/uploads/order_files', $value);
        // }

        // return $request->erp_resource_file['fileList'][0]['name'];

        // $fil = $request->erp_resource_file['fileList'][0];

        // return $fil;
        // if ($fil['name']) {


        //         $file = Storage::disk('public_uploads')->put('/uploads/order_files/'.$request->erp_resource_file['fileList'][0]['name'], $request->erp_resource_file['fileList'][0]);
        // return $file;
        // }


        // return file($request->erp_resource_file['fileList']);


        // foreach ($fil as $key => $value) {
        //     $dat = Storage::disk('public_uploads')->store('/uploads/orderFIles', $value);
        //     return $dat;
        // }


        if ($request->file('file')) {
            foreach ($request->file('file') as $key => $value) {
                $file = Storage::disk('public_uploads')->put('/uploads/create_order_files', $value);
            }
        }


        $file1 = DocumentType::where('id' , $request->erp_paper_type)->get()->first();
        $file2 = Citation_Style::where('id', $request->erp_paper_format)->get()->first();
        // return $request->erp_paper_format;
        $paperty =  $file1->erp_document_file;
        $paper_desc = $file1->erp_document_message;
        $paperfor = $file2->erp_file_type;
        $paperform_desc = $file2->erp_citation_message;
        $date_time = $this->datetimefunction($request->erp_deadline);
        $subject = $request->erp_subject_name != "other" ? $request->erp_subject_name : $request->erp_sub;

        // return $request->erp_sub;
// return $date_time;
        $data = CreateOrder::create([
            'erp_user_id'=> $user->id,
            'erp_status'=> $request->erp_status,
            'reason'=> null,
            'return_user'=> null,
            // 'erp_order_topic'=>  $request->erp_order_topic === 'other' ?$request->erp_order_text : $request->erp_order_topic,
            'erp_order_message'=> $request->erp_order_message,
            // 'erp_academic_name'=>   $request->erp_academic_name === 'other' ?$request->erp_academic_description : $request->erp_academic_name,
            // 'erp_paper_type'=> $request->erp_paper_type,
            // 'erp_subject_name'=> $request->erp_subject_name === 'other' ?$request->erp_sub : $request->erp_subject_name,
            // 'erp_paper_format'=> $request->erp_paper_format,
            // 'paperformat_file'=> $request->paperformat_file,
            // 'paperformat_desc'=> $request->paperformat_desc,
            // 'erp_team'=> $request->erp_team,
            // 'all_team'=> $request->all_team,

            'erp_academic_name'=> $request->erp_academic_name != "other" ? $request->erp_academic_name : $request->erp_academic_description,
            'erp_subject_name'=> $request->erp_subject_name != "other" ? $request->erp_subject_name : $request->erp_sub,
            'erp_order_topic'=> $request->erp_order_topic != "other" ? $subject : $request->erp_order_text,
            'erp_paper_type'=> $request->erp_paper_type != "other" ? $request->erp_paper_type : $request->erp_paper_description,
            'erp_paper_format'=> $request->erp_paper_format != "other" ? $request->erp_paper_format : $request->erp_format_description,


            'erp_language_name'=> $request->erp_language_name,
            'erp_resource_materials'=> $request->erp_resource_materials,
            'erp_resource_file'=>$file,
            'erp_number_Pages'=> $request->erp_number_Pages,
            'order_type'=> $request->order_type,
            'erp_spacing'=> $request->erp_spacing,
            'erp_powerPoint_slides'=> $request->erp_powerPoint_slides,
            'erp_extra_source'=> $request->erp_extra_source,
            // 'erp_previous'=> $request->erp_previous,
            'erp_deadline'=> $request->erp_deadline,
            'erp_datetime'=> $date_time,
            'erp_copy_sources'=> $request->erp_copy_sources,
            'erp_page_summary'=> $request->erp_page_summary,
            'order_price'=> $request->order_type==='1'?$request->order_price:null,
            'erp_paper_outline'=> $request->erp_paper_outline,
            'erp_abstract_page'=> $request->erp_abstract_page,
            'erp_statistical_analysis'=> $request->erp_statistical_analysis,


            'papertype_file' => $paperty,
            'paperformat_file'=> $paperfor,
            'papertype_desc' => $paper_desc,
            'paperformat_desc' => $paperform_desc

        ]);

        // $order = CreateOrder::leftjoin('paper_types', 'paper_types.id' , '=', 'create_orders.erp_paper_type')
        // ->where('create_orders.id',$data->id  )->where('create_orders.erp_user_id', $user->id  )->select('paper_types.erp_paper_type AS paper_type', 'create_orders.*')->get();

// return $data;
        $order = CreateOrder::leftjoin('paper_types', 'paper_types.id' , '=', 'create_orders.erp_paper_type')
            ->where('create_orders.erp_user_id',$user->id)->select('create_orders.erp_order_topic','create_orders.is_paid', 'create_orders.id', 'create_orders.order_type', 'create_orders.erp_academic_name', 'create_orders.erp_resource_materials', 'create_orders.erp_order_message','create_orders.erp_paper_format','paper_types.erp_paper_type',   'create_orders.erp_language_name')->get()->all();


        if ($data) {
            return ['success' => true, 'message' => 'Order Created Successfully!','order'=>$order];
        }
        else{
            return ['success' => false, 'message' => 'Something went wrong!'];
        }
    }

    public function datetimefunction($date_time){
        $current_date =date('Y-m-d H:i:s');
        if($date_time == 'erp_eight_hrs'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+8 hour'));
        }elseif($date_time == 'erp_tf_hrs'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+1 days'));
        }elseif($date_time == 'erp_fe_hrs'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+2 days'));
        }elseif($date_time == 'erp_three_days'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+3 days'));
        }elseif($date_time == 'erp_five_days'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+5 days'));
        }elseif($date_time == 'erp_seven_days'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+7 days'));
        }elseif($date_time == 'erp_fourteen_days'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+14 days'));
        }elseif($date_time == 'erp_fourteen_plus_days'){
            $convertedTime = date('Y-m-d H:i:s',strtotime($current_date.'+24 days'));
        }
        return $convertedTime;
    }

    public function fetchOrder(Request $request)
    {
        $user = User::where('user_token',$request->user_token)->get()->first();
        $data = CreateOrder::leftjoin('paper_types', 'paper_types.id' , '=', 'create_orders.erp_paper_type')
            ->where('create_orders.erp_user_id',$user->id)->select('create_orders.erp_order_topic','create_orders.is_paid', 'create_orders.id', 'create_orders.order_type', 'create_orders.erp_academic_name', 'create_orders.erp_resource_materials', 'create_orders.erp_order_message','create_orders.erp_paper_format','paper_types.erp_paper_type',   'create_orders.erp_language_name')->get()->all();

        // return $data;

        if($data)
        {
            return ['success'=>true,  'order'=>$data ,'message' => 'Your Order Has been Retrived successfully.'];
        }else{
            return ['success'=>false, 'message'=>'Something Went Wrong.' ];
        }

    }

    public function fetchOrderByOrderId(Request $request)
    {
        $user = User::where('user_token',$request->user_token)->get()->first();

        // return $user;
        $data = CreateOrder::leftjoin('paper_types', 'paper_types.id' , '=', 'create_orders.erp_paper_type')
            ->where('create_orders.id',$request->order_id  )->where('create_orders.erp_user_id', $user->id  )->select('paper_types.erp_paper_type AS paper_type', 'create_orders.*')->get();

        if(count($data))
        {
            return ['success'=>true,  'data'=>$data ,'message' => 'Your Order Has been Retrived successfully.'];
        }
        else{
            return ['success'=>false, 'message'=>'Order not found.' ];
        }

    }
    public function fetchFiles(Request $request)
    {

        // $user = CreateOrder::where('id',$request->user_token)->get()->first();

        $FileTitle = FileTitle::where('files_title.order_id',$request->order_id)
            // ->Leftjoin('users', 'users.id', '=' , 'files_title.user_id')
            // ->leftjoin('files', 'files_title.id', '=' , 'files.file_id')
            // ->select('files.file','files_title.title','files_title.created_at', 'users.name', 'files.file_id' , 'users.user_token')
            ->get();

        $data=[];

        foreach($FileTitle as $FileTitles){
            $files = Files::where('file_id',$FileTitles->id)->get();
            $user = User::where('id',$FileTitles->user_id)->get()->first();
            $data[] = [
                'id'=>$FileTitles->id,
                'title'=>$FileTitles->title,
                'type'=>$FileTitles->type,
                'files'=>$files,
                'name'=>$user->name,
                'user_token'=>$user->user_token,
                'created_at'=>$FileTitles->created_at->format('Y/m/d H:i a'),
            ];
        }

        //    return $data;


        if($data)
        {
            return ['success'=>true,  'data'=>$data ,'message' => 'Your Order Has been Retrived successfully.'];
        }else{
            if(count($data)===0){

                return ['success'=>2, 'message'=>'Something Went Wrong.' ];
            }
            else{
                return ['success'=>false, 'message'=>'Something Went Wrong.' ];

            }
        }

    }

    // public function manageMessages(Request $request)
    //     {
    //         $abc = FileTitle::create([
    //             'title'=> $request->txt,
    //             'user_id'=> $user->id,
    //             'order_id'=> $request->order_id,
    //             'type'=> $request->type,
    //         ]);

    // }


    public function manageFiles(Request $request)
    {
        // return $request->file('file');


        $user = User::where('user_token',$request->user_token)->get()->first();

        $paths = [];

        // return $request->type;

        $abc = FileTitle::create([
            'title'=> $request->txt,
            'user_id'=> $user->id,
            'order_id'=> $request->order_id,
            'type'=> $request->type,

        ]);
        // foreach ($request->file('file') as $key => $value) {
        //     $data = Storage::disk('public_uploads')->put('/uploads', $value);

        //     $res = Files::create([
        //         'user_id'=> $user->id,
        //         'order_id'=> $request->order_id,
        //         'file'=> $data,
        //     ]);

        //     array_push($paths, $res->file);
        // }


        $res =(Object)[
            'file_id'=> null,
        ];



        if ($request->file('file')) {


            foreach ($request->file('file') as $key => $value) {
                $data = Storage::disk('public_uploads')->put('/uploads/files/'.$request->order_id, $value);

                $res = Files::create([

                    'file_id'=> $abc->id,
                    'file'=> $data,
                    'file_name'=> $value->getClientOriginalName()

                ]);

                // return $value->getClientOriginalName();

                array_push($paths, $res);

            }

        }


        if($abc)
        {
            return ['success'=>true,  'path'=>$paths , 'title' => $request->txt, 'type' => $request->type , "files"=>$paths , 'created_at'=>$abc->created_at->format('Y/m/d H:i a')  ,"file_id"=> $res->file_id,'message' => 'File Uploaded successfully.'];
        }else{
            return ['success'=>false, 'message'=>'Something Went Wrong.' ];
        }


        // return $request->file('file')->storeAs(
        //     'public/uploads', 'ggg.pdf'
        // );
        // $image = $request->file('file');
        // $image->store(storage_path('public/uploads'));


        //     if ($request->file('file')) {
        //         $mainext = $request->file('file')->getClientOriginalExtension();
        //         dd($mainext);
        //         $main_file = Str::random(40).'.'.$mainext;
        //         $request->file->move(public_path('public/uploads'),$main_file);
        //     } else {
        //         $main_file = null;
        //  }



        // $fileTemp= $request->file('file')->store('');
        // // $fileTemp = $request->file('file');
        // $fileExtension = $fileTemp->getClientOriginalExtension();
        // $fileName = Str::random(4). '.'. $fileExtension;
        // $path = $fileTemp->storeAs(
        //     'public/uploads', $fileName
        // );
    }

    public function GetSiteSetting()
    {
        return  Settings::get()->first();
    }

}
