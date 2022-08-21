<?php

namespace App\Http\Controllers;
use App\Helper\serviceHelper;
use Illuminate\Http\Request;

class ContactController extends Controller
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
        $page['heading']="contact";
        $page['title']="Contact";
        $arr=[];
        $location=serviceHelper::getSettings('LOCATION')->value;
        $email1=serviceHelper::getSettings('EMAIL1')->value;
        $email2=serviceHelper::getSettings('EMAIL2')->value;
        $phone1=serviceHelper::getSettings('PHONE1')->value;
        $phone2=serviceHelper::getSettings('PHONE2')->value;
        return view('contact',[
            'location'=>$location, 
            'emailone'=>$email1,
            'emailtwo'=>$email2,
            'phoneone'=>$phone1,
            'phonetwo'=>$phone2,
            'page'=>$page
        ]); 
    }
}
