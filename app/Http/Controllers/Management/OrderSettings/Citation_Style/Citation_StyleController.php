<?php

namespace App\Http\Controllers\Management\OrderSettings\Citation_Style;

use App\Http\Controllers\Controller;
use App\Models\OrderSettings\Citation_Style\Citation_Style;
use Illuminate\Http\Request;
class Citation_StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Citation_Style::latest('created_at')->get();
        return view('management/OrderSettings/Citation_Style/index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request , [
            "erp_title"=>"required",
            "erp_citation_message"=>"required",
            "erp_file_type" => 'required',
            "erp_datetime"=>"required",
            "erp_status"=>"required",
        ]);
        if($request->file('erp_file_type')){
            $ext = $request->file('erp_file_type')->getClientOriginalExtension();
            $txt = time().rand(100,1000).'.'.$ext;
            $request->erp_file_type->move(public_path('image/announcement'),$txt);
        }
        else
        {
            $txt = '';
        }

        $data=[
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_title'=>$request->erp_title,
            'erp_citation_message'=>$request->erp_citation_message,
            'erp_datetime'=>$request->erp_datetime,
            'erp_date'=>$request->erp_date,
            'erp_file_type'=>$txt,
        ];
        $citation_style = Citation_Style::Create($data);

        return redirect()->back()->with('success','Your Data Has Been Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return \Illuminate\Http\Response
     */
    public function show(CRUD $cRUD)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('management/quiz/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CRUD  $cRUD
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data= Citation_Style::where('id',$id)->get()->first();

        $this->validate($request , [
            "erp_title"=>"required",
            "erp_citation_message"=>"required",
            "erp_datetime"=>"required",
            "erp_status"=>"required",
        ]);

        if($request->file('erp_file_type')){
            $ext = $request->file('erp_file_type')->getClientOriginalExtension();
            $txt = time().rand(100,1000).'.'.$ext;
            $request->erp_file_type->move(public_path('image/announcement'),$txt);
        }

        else
        {
            $txt = $data->erp_file_type;
        }

        $data->update([
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_title'=>$request->erp_title,
            'erp_citation_message'=>$request->erp_citation_message,
            'erp_datetime'=>$request->erp_datetime,
            'erp_date'=>$request->erp_date,
            'erp_file_type'=>$txt,
        ]);
        return redirect()->back()->with('success','Data Has Been Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Citation_Style::where('id',$id)->get()->first()->delete();

        return redirect()->back()->with('success','Data Has Been Deleted');
    }
}
