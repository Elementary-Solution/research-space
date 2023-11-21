<?php

namespace App\Http\Controllers\Management\OrderSettings\LanguageStyle;

use App\Http\Controllers\Controller;
use App\Models\OrderSettings\LanguageStyle\LanguageStyle;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class LanguageStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $raja=array("red","green","green","raja","raja");
//        $baja=array("blue","yellow",30,30,40);
////           array('yasir'=>'audio');
////           array('anas'=>'civic');
////           array('raja'=>'mehran');
//
//        @foreach (array_combine($raja,$baja) as $x => $y) {
//
//        }
//        @endforeach

        $data = LanguageStyle::get();
        return view('management/OrderSettings/LanguageStyle/index',compact('data'));
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
        $this->validate($request , [
            "erp_status"=>"required",
            "erp_language_name"=>"required",
        ]);

        $data=[
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_language_name'=>$request->erp_language_name,
        ];

        $language_name = LanguageStyle::Create($data);
        return redirect()->back()->with('success','Data Has Been Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LanguageStyle  $languageStyle
     * @return \Illuminate\Http\Response
     */
    public function show(LanguageStyle $languageStyle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LanguageStyle  $languageStyle
     * @return \Illuminate\Http\Response
     */
    public function edit(LanguageStyle $languageStyle)
    {
        return view('management/quiz/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LanguageStyle  $languageStyle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=LanguageStyle::where('id',$id)->get()->first();
        $this->validate($request , [
            "erp_status"=>"required",
            "erp_language_name"=>"required",
        ]);

        $data->update([
            'erp_user_id'=>auth()->user()->id,
            'erp_status'=>$request->erp_status,
            'erp_language_name'=>$request->erp_language_name,
        ]);
        return redirect()->back()->with('success','Your Data Has Been Inserted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LanguageStyle  $languageStyle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=LanguageStyle::where('id',$id)->get()->first()->delete();

        return redirect()->back()->with('success','Data Has Been Deleted');
    }
}
