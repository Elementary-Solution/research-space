<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\categories;
use App\Models\media;
use App\Models\seo;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscription = Subscription::latest()->get();
        return view('management.subscription.index', compact('subscription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $subscription = Subscription::create($data);
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
        $subscription = Subscription::where('id', $id)->get()->first();
        $seo = seo::where('reference_id', $id)->where('reference_type', 'subscription')->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type', 'subscription')->get()->first();

        // return $subscription;
        return view('management.subscription.edit', compact('subscription', 'seo', 'media'));
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
        $subscription = Subscription::where('id', $id)->get()->first();
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
