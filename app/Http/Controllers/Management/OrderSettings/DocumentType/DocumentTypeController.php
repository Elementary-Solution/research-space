<?php

namespace App\Http\Controllers\Management\OrderSettings\DocumentType;

use App\Http\Controllers\Controller;
use App\Models\OrderSettings\DocumentType\DocumentType;
use Illuminate\Http\Request;
class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DocumentType::get();
        return view('management/OrderSettings/DocumentType/index',compact('data'));
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
            "erp_status"=>"required",
            "erp_document_title"=>"required",
            "erp_document_message"=>"required",
            "erp_document_file"=>"required",
        ]);

        if($request->file('erp_document_file')){
            $ext = $request->file('erp_document_file')->getClientOriginalExtension();
            $txt = time().rand(100,1000).'.'.$ext;
            $request->erp_document_file->move(public_path('image/announcement'),$txt);
        }

        else
        {
            $txt = '';
        }
        $data=[
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_document_title'=>$request->erp_document_title,
            'erp_document_message'=>$request->erp_document_message,
            'erp_document_file'=>$txt,
        ];

        $document_type = DocumentType::Create($data);
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

        $data=DocumentType::where('id',$id)->get()->first();
        $this->validate($request , [
            "erp_status"=>"required",
            "erp_document_title"=>"required",
            "erp_document_message"=>"required",

        ]);

        if($request->file('erp_document_file')){
            $ext = $request->file('erp_document_file')->getClientOriginalExtension();
            $txt = time().rand(100,1000).'.'.$ext;
            $request->erp_document_file->move(public_path('image/announcement'),$txt);
        }

        else
        {
            $txt = $data->erp_document_file;
        }

        $data->update([
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_document_title'=>$request->erp_document_title,
            'erp_document_message'=>$request->erp_document_message,
            'erp_document_file'=>$txt,
        ]);
        return redirect()->back()->with('success','Your Data Has Been Inserted');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=DocumentType::where('id',$id)->get()->first()->delete();

        return redirect()->back()->with('success','Data Has Been Deleted');
    }
}
