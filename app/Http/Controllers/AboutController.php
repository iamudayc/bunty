<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
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
        $page['heading']="About-Us";
        $page['title']="About Us";
        $arr=[];
        return view('about',['data'=>$arr, 'page'=>$page]); 
    }

    public function privacy()
    {
        $page['heading']="Privacy-Policy";
        $page['title']="Privacy Policy";
        $arr=[];
        return view('privacy',['data'=>$arr, 'page'=>$page]); 
    }

    public function terms()
    {
        $page['heading']="Terms-Condition";
        $page['title']="Terms & Condition";
        $arr=[];
        return view('terms',['data'=>$arr, 'page'=>$page]); 
    }
}
