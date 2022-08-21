<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Helper\general;

use Illuminate\Http\Request;

class TestimonialController extends Controller
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
        $page['heading']="testimonial";
        $page['title']="Testimonial";
        $arr=[];

        $review=Review::with('userDetails')->where('status',1)->where('deleted',0)->orderBy('id','DESC')->get();
        $photo=url('public/user.jpg');
        if(count($review)>0)
        {
            $i=0;
            foreach($review as $details)
            {
                $user_details=general::getUser($details->user_code);
                //dd($user_details['image']);
                $i=$i+1;
                if(!empty($user_details['image']))
                {
                    $photo=$user_details['image'];
                }
               // dd($photo);
                //print_r($details->toArray());
                $arr[]=[
                    'profession'=>$details->profession,
                    'description'=>$details->description,
                    'name'=>$details->userDetails->first_name.' '.$details->userDetails->last_name,
                    //'name'=>'aa',
                    'image'=>$photo,
                    'delay'=>$i*100,
                ];
                $i++;
            }
            //$arr=$review;
        }
       // dd($arr);
        return view('testimonial',['data'=>$arr, 'page'=>$page]); 
    }
}
