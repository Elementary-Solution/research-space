<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CreateOrder;
use App\Models\categories;
use App\Models\media;
use App\Models\Files;
use App\Models\FileTitle;
use App\Models\User;
use App\Models\seo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrderSettings\AcademicLevel\AcademicLevel;
use App\Models\OrderSettings\Citation_Style\Citation_Style;
use App\Models\OrderSettings\DocumentType\DocumentType;
use App\Models\OrderSettings\LanguageStyle\LanguageStyle;
use App\Models\OrderSettings\PaperFormat\PaperFormat;
use App\Models\OrderSettings\PaperType\PaperType;
use App\Models\OrderSettings\SubjectType\SubjectType;

class ManageOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->status === 'progress') {
            $status = 2;
        }elseif($req->status === 'completed'){ 
            $status = 3;
        }
        elseif($req->status === 'cancelled'){
            $status = 4; 
        }
        else{
            $status = 0; 
        }

        $order = CreateOrder::leftjoin('users', 'users.id', '=', 'create_orders.erp_user_id')->where('create_orders.erp_status' ,$status)
        ->select('users.name', 'create_orders.*' )->get();
  
        

        return view('management.manage_order.index', compact('order' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $academic_level_data = AcademicLevel::get();
        $citation_style_data = Citation_Style::get();
        $document_type_data = DocumentType::get();
        $language_style_data = LanguageStyle::get();
        $paper_format_data = PaperFormat::get();
        $paper_type_data = PaperType::get();
        $subject_type_data = SubjectType::get();

        $academic_level = [];
        $citation_style = [];
        $document_type = [];
        $language_style = [];
        $paper_format = [];
        $paper_type = [];
        $subject_type = [];



        foreach ($academic_level_data as $key => $value) {

            array_push($academic_level, (object)[
                'label' => $value->erp_academic_name,
                'value' => $value->erp_academic_name,
            ]);

        };
        foreach ($citation_style_data as $key => $value) {

            array_push($citation_style, (object)[
                'label' => $value->erp_title,
                'value' => $value->erp_title,
            ]);

        };
        foreach ($document_type_data as $key => $value) {

            array_push($document_type, (object)[
                'label' => $value->erp_document_title,
                'value' => $value->erp_document_title,
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

        $data =   [
            'academic_level'=>$academic_level,
            'citation_style'=>$citation_style,
            'document_type'=>$document_type,
            'language_style'=>$language_style,
            'paper_format'=>$paper_format,
            'paper_type'=>$paper_type,
            'subject_type'=>$subject_type
        ];

        // return $data;

        return view('management.manage_order.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)

    {

        
        if($request->permission == 'writing-service'){
        $validatedData = $request->validate([
            'title' => 'required',
            'status' => 'required',
            'subscription_duration' => 'required',
            'duration_type' => 'required',
            'minimum_allowed' => 'required',
            'maximum_allowed' => 'required',
            'actual_price_per_page' => 'required',
            'compare_price_per_page' => 'required',
            'permission' => 'required'
        ]);
        }else{
            $validatedData = $request->validate([
                'title' => 'required',
                'status' => 'required',
                'subscription_duration' => 'required',
                'duration_type' => 'required',
                'actual_price' => 'required',
                'compare_price' => 'required',
                'permission' => 'required'
            ]);
        }
        if ($request->file('image')) {
            $mainext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'subscription' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = null;
        }
        // $data = [
        //     'user_id' => auth()->user()->id,
        //     'category_id' => $request->category_id,
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'status' => $request->status,
        //     'no_of_pages' => $request->no_of_pages,
        //     'subscription_duration' => $request->subscription_duration,
        //     'regular_price' => $request->regular_price,
        //     'discount_price' => $request->discount_price,
        //     'stock' => $request->stock,
        //     'image' => $main_file,
        // ];

        $data = [
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'subscription_duration' => $request->subscription_duration,
//            'image' => $request->image,


            'duration_type' => $request->duration_type,
            'minimum_pages_allowed' => isset($request->minimum_allowed) ? $request->minimum_allowed : null,
            'maximum_pages_allowed' =>isset($request->maximum_allowed) ? $request->maximum_allowed : null,
            'actual_price_per_page' => isset($request->actual_price_per_page) ? $request->actual_price_per_page : null,
            'compare_price_per_page' =>isset($request->compare_price_per_page) ? $request->compare_price_per_page : null, $request->compare_price_per_page,
            'actual_price' => isset($request->actual_price) ? $request->actual_price : null,
            'compare_price' => isset($request->compare_price) ? $request->actual_price : null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'permission' => $request->permission,
            'minimum_addon_allowed' =>isset($request->minimum_addon_allowed) ? $request->minimum_addon_allowed : null,
            'maximum_addon_allowed' => isset($request->maximum_addon_allowed) ? $request->maximum_addon_allowed : null,
        ];

        // return $data;
        $subscription = CreateOrder::create($data);
        $multi_image =
            [
                'reference_id' => $subscription->id,
                'reference_type' => 'subscription',
                'image' => $main_file,
            ];

        $multi = media::create($multi_image);
        $seo = [
            'reference_id' => $subscription->id,
            'reference_type' => 'subscription',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];
        $search = seo::create($seo);
        return redirect()->back()->with('success', 'Subscription Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 

        $FileTitle = FileTitle::where('files_title.order_id',$id)
        // ->Leftjoin('users', 'users.id', '=' , 'files_title.user_id')
                    // ->leftjoin('files', 'files_title.id', '=' , 'files.file_id')
                    // ->select('files.file','files_title.title','files_title.created_at', 'users.name', 'files.file_id' , 'users.user_token')
                    ->get();

        $messages=[];

        foreach($FileTitle as $FileTitles){
            $files = Files::where('file_id',$FileTitles->id)->get();
            $user = User::where('id',$FileTitles->user_id)->get()->first();
            $messages[] = [
                'id'=>$FileTitles->id,
                'title'=>$FileTitles->title,
                'type'=>$FileTitles->type,
                'files'=>$files,
                'name'=>$user->name,
                'user_token'=>$user->user_token,
                'created_at'=>$FileTitles->created_at->format('Y/m/d H:i a'),
            ];
        }


        $data = CreateOrder::where('id', $id)->get()->first(); 
  
        $time = Carbon::now()->diff($data->erp_datetime);
        // return '<td>' . $time->y . ' Year' . $time->m . ' Month' . $time->d . ' Day' . '</td>';
        // return $time;
        // dd($time);
        $remaintime = $time->d .' Days '. $time->h-5 .' Hours '. $time->i .' Minutes';

        // return $time->d .' Days '. $time->h-5 .' Hours '. $time->i .' Minutes';
        // return $messages;

        // return $data;
        return view('management.manage_order.show', compact('data','messages', 'remaintime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subscription = CreateOrder::where('id', $id)->get()->first();
        $multi = media::where('reference_id', $id)->where('reference_type', 'subscription')->get()->first();
        if ($request->file('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'subscription' . time() . rand(1000, 14000000000) . '.' . $ext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = $multi->image;
        }

        $subscription->update([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'no_of_pages' => $request->no_of_pages,
            'subscription_duration' => $request->subscription_duration,
            'regular_price' => $request->regular_price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'image' => $main_file,
        ]);


        if ($multi != null) {
            $multi->update([
                'image' => $main_file,
            ]);
        } else {
            $multi_image =
                [
                    'reference_id' => $id,
                    'reference_type' => 'subscription',
                    'image' => $main_file,
                ];

            media::create($multi_image);
        }

        $seo = seo::where('reference_id', $subscription->id)->get()->first();

        $seo->update([
            'reference_id' => $subscription->id,
            'meta_title' => $request->meta_title,
            'reference_type' => 'subscription',
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->back()->with('success', 'Subscription Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription = Subscription::where('id', $id)->delete();
        $seos = seo::where('reference_id', $id)->where('reference_type','subscription')->delete();
        return redirect()->back()->with('success', 'Subscription Deleted Successfully');
    }
}
