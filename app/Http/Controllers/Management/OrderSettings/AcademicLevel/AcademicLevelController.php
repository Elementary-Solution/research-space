<?php

namespace App\Http\Controllers\Management\OrderSettings\AcademicLevel;

use App\Http\Controllers\Controller;
use App\Models\OrderSettings\AcademicLevel\AcademicLevel;
use Illuminate\Http\Request;
class AcademicLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AcademicLevel::get();
        return view('management/OrderSettings/academic_level/index',compact('data'));
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
            "erp_academic_name"=>"required",
        ]);

        $data=[
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_academic_name'=>$request->erp_academic_name,
        ];

        $academic_level = AcademicLevel::Create($data);
        return redirect()->back()->with('success','Data Has Been Inserted');
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
        $data=AcademicLevel::where('id',$id)->get()->first();
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
        $data=AcademicLevel::where('id',$id)->get()->first();
        $this->validate($request , [
            "erp_status"=>"required",
            "erp_academic_name"=>"required",
        ]);

        $data->update([
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_academic_name'=>$request->erp_academic_name,
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
       $data=AcademicLevel::where('id',$id)->get()->first()->delete();

        return redirect()->back()->with('success','Data Has Been Deleted');
    }
}
