<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

use App\Models\categories;
use App\Models\Product;
use App\Models\coupon;
use App\Models\media;
use App\Models\ProductInCategory;
use App\Models\store;
use App\Models\seo;
use Illuminate\Http\Request;
use Route;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = categories::get();
        return view('management/categories/index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = categories::get();
        return view('management/categories/create', compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_type = base64_decode($_GET['type']);
        if (isset($_GET['type'])) {
            if ($request->file('image')) {
                $mainext = $request->file('image')->getClientOriginalExtension();
                $main_file = 'categories' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $request->image->move(public_path('images/media'), $main_file);
            } else {
                $main_file = null;
            }
        }
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'reference_type' => $category_type,
            'image' => $main_file,
            'parent_category' => $request->parent_category,
        ];
        $categories = categories::create($data);
        $multi_image =
            [
                'reference_id' => $categories->id,
                'reference_type' => 'categories',
                'image' => $main_file,
            ];
        $multi = media::create($multi_image);
        $seo = [
            'reference_id' => $categories->id,
            'meta_title' => $request->meta_title,
            'reference_type' => $category_type,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];
        $search = seo::create($seo);
        return redirect()->back()->with('success', 'Category Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\categories $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories, $id)
    {
        $multi = media::where('reference_id', $id)->where('reference_type', 'categories')->get()->first();
        $category = categories::where('id', $id)->get()->first();
        $all_category = categories::get();
        $seo = seo::where('reference_id', $category->id)->get()->first();
        return view('management/categories/edit', compact('category', 'multi', 'seo', 'all_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\categories $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\categories $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $multi = media::where('reference_id', $id)->where('reference_type', 'categories')->get()->first();
        $categories = categories::where('id', $id)->get()->first();
        $category_type = base64_decode($_GET['type']);
        if ($request->file('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'categories' . time() . rand(1000, 14000000000) . '.' . $ext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = $multi->image;
        }
        $categories->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'reference_type' => $category_type,
            'image' => $main_file,
            'parent_category' => $request->parent_category,
        ]);
        $seo = seo::where('reference_id', $categories->id)->get()->first();
        $seo->update([
            'reference_id' => $categories->id,
            'meta_title' => $request->meta_title,
            'reference_type' => $category_type,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        if ($multi != null) {
            $multi->update([
                'image' => $main_file,
            ]);
        } else {
            $multi_image =
                [
                    'reference_id' => $id,
                    'reference_type' => 'categories',
                    'image' => $main_file,
                ];
            media::create($multi_image);
        }
        return redirect()->back()->with('success', 'Category Updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\categories $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(categories $categories, $id)
    {
        $categories = categories::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }

}

