<?php

namespace App\Http\Controllers\MobileApp;

use App\Http\Controllers\Controller;

use App\Models\store;
use App\Models\Contact;
use App\Models\coupon;
use App\Models\Newsletter;
use App\Models\media;
use http\Url;
use Illuminate\Http\Request;
use DB;

class CouponDetailController extends Controller
{

    public function CouponDetail($coupon)
    {
        dd('gunug');
        $coun = 226;

        $query = coupon::where('status', 1)
            ->where('id','>',isset($request->since_id) ? $request->since_id : 0);
        if(isset($request->category_id)){
            $query = $query->where('category_id',$request->category_id);
        }if (isset($request->store_id)){
        $query = $query->where('store_id',$request->store_id);
    }



        if(isset($request->paginate)){
            $coupon = $query->paginate($request->paginate);
        }else{
            $coupon = $query->get();
        }






        dd($coupon);

    }
    

}
