<?php

namespace App\Http\Controllers\Management\OrderSettings\PaperFormat;

use App\Http\Controllers\Controller;
use App\Models\OrderSettings\PaperFormat\PaperFormat;
use Illuminate\Http\Request;
class PaperFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaperFormat::get();
        return view('management/OrderSettings/paper_format/index',compact('data'));

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
            "erp_paper_format"=>"required",
        ]);

        $data=[
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_paper_format'=>$request->erp_paper_format,
        ];

        $paper_format = PaperFormat::Create($data);
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
        $data=PaperFormat::where('id',$id)->get()->first();
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
        $data=PaperFormat::where('id',$id)->get()->first();
        $this->validate($request , [
            "erp_status"=>"required",
            "erp_paper_format"=>"required",
        ]);

        $data->update([
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_paper_format'=>$request->erp_paper_format,
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
        $data=PaperFormat::where('id',$id)->get()->first()->delete();

        return redirect()->back()->with('success','Data Has Been Deleted');
    }
}
