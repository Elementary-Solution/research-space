<?php

namespace App\Http\Controllers\Management;
use App\Http\Controllers\Controller;

use App\Models\Paper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paper = Paper::latest()->get();
        return view('management.paper.index', compact('paper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.paper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('file_upload')) {
            $mainext = $request->file('file_upload')->getClientOriginalExtension();
            $main_file = Str::random(40).'.'.$mainext;
            $request->file_upload->move(public_path('document/file'),$main_file);
        } else {
            $main_file = null;
        }

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'summary' => $request->summary,
            'status' => $request->status,
            'type' => $request->type,
            'file_upload' =>$main_file,
        ];
        $paper = Paper::create($data);
        return redirect()->back()->with('success', 'Paper Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paper = Paper::where('id', $id)->get()->first();
        return view('management.paper.edit', compact('paper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $paper = Paper::where('id', $id)->get()->first();
        if ($request->file('file_upload')) {
            $mainext = $request->file('file_upload')->getClientOriginalExtension();
            $main_file = Str::random(40).'.'.$mainext;
            $request->file_upload->move(public_path('document/file'), $main_file);
        } else {
            $main_file = $paper->file_upload;
        }

        $paper->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'summary' => $request->summary,
            'status' => $request->status,
            'type' => $request->type,
            'file_upload' =>$main_file,
        ]);

        return redirect()->back()->with('success', 'Paper Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paper = Paper::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Paper Deleted Succesfully');
    }
}
