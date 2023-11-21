<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\CouponDiscount;
use Illuminate\Http\Request;

class CoupenDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon_discount = CouponDiscount::latest()->get();
        return view('management.coupon_discount.index', compact('coupon_discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.coupon_discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            "title" => $request->title,
            "discount_code" => $request->discount_code,
            "value" => $request->value,
            "status" => $request->status,
            'start_date' => $request->start_date,
            'expiry_date' => $request->expiry_date,
        ];

        $coupon_discount = CouponDiscount::create($data);
        return redirect()->back()->with('success', 'Coupon  Discount Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CoupenDiscount $coupenDiscount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = CouponDiscount::where('id', $id)->get()->first();
        return view('management/coupon_discount/edit', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CoupenDiscount $coupenDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(CoupenDiscount $coupenDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CoupenDiscount $coupenDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = CouponDiscount::where('id', $id)->get()->first();
        $data->update([
            "title" => $request->title,
            "discount_code" => $request->discount_code,
            "value" => $request->value,
            "status" => $request->status,
            'start_date' => $request->start_date,
            'expiry_date' => $request->expiry_date,
        ]);
        return redirect()->back()->with('success', 'Coupon  Discount Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CoupenDiscount $coupenDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CouponDiscount::where('id', $id)->get()->first()->delete();
        return redirect()->back()->with('success', 'Coupon  Discount Delete successfully');
    }
}
