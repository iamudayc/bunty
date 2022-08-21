<?php

namespace App\Http\Controllers;
use App\Models\Career;


use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $career=Career::where('status',1)->orderBy('id','DESC')->get();
        $page['heading']="career";
        $page['title']="Career";
        $arr=$career;
        return view('career',['data'=>$arr, 'page'=>$page]); 
    }
}
