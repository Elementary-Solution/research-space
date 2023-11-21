<?php

namespace App\Http\Controllers\MobileApp;

use App\Http\Controllers\Controller;

use App\Http\Controllers\MainAppController;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use DB;

class MainAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:subscriber-list', ['only' => ['subscriber']]);
        $this->middleware('permission:contact-list', ['only' => ['index']]);
        $this->middleware('permission:contact-show', ['only' => ['edit','update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }
    public function AllCoupons()
    {

      $data = Coupon::get()->all();
      return view('management/contact/index',compact('data'));

    }
    public function subscriber()
    {

        $data = Newsletter::get()->all();
        return view('management/contact/newsletter',compact('data'));

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
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $data = Contact::where('id',$id)->get()->first();
        return view('management/contact/edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Contact::where('id',$id)->delete();
        return  redirect()->back()->with('success', 'Contact Deleted Succesfully');
    }

}
