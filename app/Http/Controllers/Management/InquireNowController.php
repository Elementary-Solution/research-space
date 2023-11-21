<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\InquireNow;
use Illuminate\Http\Request;

class InquireNowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InquireNow::latest()->get();
        return view('management/inquire/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InquireNow  $inquireNow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = InquireNow::leftjoin('subscriptions','subscriptions.id','=','inquire_nows.product_id')
                 ->where('inquire_nows.id',$id)
                 ->select('inquire_nows.*','subscriptions.title')
                 ->latest()->get()->first();
        return view('management/inquire/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InquireNow  $inquireNow
     * @return \Illuminate\Http\Response
     */
    public function edit(InquireNow $inquireNow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InquireNow  $inquireNow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InquireNow $inquireNow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InquireNow  $inquireNow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inquireNow = InquireNow::where('id', $id)->delete();
        return redirect()->back()->with('success', 'InquireNow Deleted Successfully');
    }
}
