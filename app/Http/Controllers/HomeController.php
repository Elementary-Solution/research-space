<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*if(!auth()->user()->hasPermissionTo('dashboard-permission')){
//            return abort(401);
            return redirect('/')->with('wrong','Unauthorized');

        }*/
        $order = [];

//        $contact = [];
        $order = Contact::latest()->paginate(5);
        return view('management/home/index',compact('order'));

//        return view('home');
    }
}
