<?php

namespace App\Http\Controllers\Management;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\CreateOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomController extends Controller
{
    public function index()
    {
        // $data = Order::leftjoin('subscriptions','subscriptions.id','=','orders.subscription_id')
        //                ->leftjoin('users','users.id','=','orders.user_id')
        //                ->leftjoin('shipment_details','orders.id','=','shipment_details.order_id')  
        //                ->leftJoin('create_orders', 'create_orders.id', '=', 'orders.custom_order_id')
        //                ->select('users.name','orders.id AS orderid','orders.no_of_pages','subscriptions.title','create_orders.erp_academic_name AS custom_title','create_orders.is_paid','create_orders.id AS custom_slug','create_orders.erp_deadline AS custom_duration','subscriptions.subscription_duration','orders.order_total', 'shipment_details.*')->get();

                    //    dd($data);
                //  return $data;
        $data=CreateOrder::leftjoin('users','create_orders.erp_user_id','users.id')
                           ->select('users.name','create_orders.*')
                           ->get();
        return view('management.custom_order.index',compact('data'));
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $data = Order::leftjoin('subscriptions','subscriptions.id','=','orders.subscription_id')
            ->leftjoin('users','users.id','=','orders.user_id')
            ->leftjoin('shipment_details','orders.id','=','shipment_details.order_id')
            ->leftJoin('create_orders', 'create_orders.id', '=', 'orders.custom_order_id')
            ->where('orders.id',$id)
            ->select('orders.id','users.id AS userid','users.*' ,'create_orders.erp_academic_name AS custom_title','create_orders.id AS custom_slug','create_orders.erp_deadline AS custom_duration','subscriptions.title','shipment_details.billing_email','shipment_details.billing_first_name','shipment_details.billing_last_name','shipment_details.billing_phone','shipment_details.billing_country','shipment_details.billing_city','orders.grand_total','orders.coupon_discount','orders.no_of_pages','orders.order_total','shipment_details.billing_street_address','subscriptions.subscription_duration')->get()->first();
        // return $data;
        
            return view('management.orders.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
