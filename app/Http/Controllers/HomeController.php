<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\serviceHelper;
use App\Models\Banner;
use App\Models\Review;
use App\Helper\general;

class HomeController extends Controller
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
        $bannerfirst = Banner::where('status',1)->orderBy('id','ASC')->first();
        $bannerrest = Banner::where('status',1)->where('id','>',1)->orderBy('id','ASC')->get();
        $review = Review::with('userDetails')->where('status',1)->where('deleted',0)->inRandomOrder()->limit(4)->get();
        $photo=url('public/user.jpg');
        $reviewarr=[];
        if(count($review)>0)
        {
            $i=0;
            foreach($review as $details)
            {
                $user_details=general::getUser($details->user_code);               
                $i=$i+1;
                if(!empty($user_details['image']))
                {
                    $photo=$user_details['image'];
                }
                $reviewarr[]=[
                    'profession'=>$details->profession,
                    'description'=>$details->description,
                    'name'=>$details->userDetails->first_name.' '.$details->userDetails->last_name,
                    'image'=>$photo,
                    'delay'=>$i*100,
                ];
                $i++;
            }
        }
        $page['heading']="home";
        $page['title']="Home";
        $arr=[
            'PAGE_HEADING'=>serviceHelper::getService('PAGE_HEADING')->value,
            'PAGE_DESCRIPTION'=>serviceHelper::getService('PAGE_DESCRIPTION')->value,
            'STOCK_BROKING'=>serviceHelper::getService('STOCK_BROKING')->value,
            'MUTUAL_FUND'=>serviceHelper::getService('MUTUAL_FUND')->value,
            'INVESTMENT_PLANNING'=>serviceHelper::getService('INVESTMENT_PLANNING')->value,
            'INSURANCE'=>serviceHelper::getService('INSURANCE')->value,
            'PMS'=>serviceHelper::getService('PMS')->value,
            'LOAN'=>serviceHelper::getService('LOAN')->value,
            'EDUCATION'=>serviceHelper::getService('EDUCATION')->value,
            'CAREER'=>serviceHelper::getService('CAREER')->value,
        ];

        return view('home',[
                'data'=>$arr, 
                'page'=>$page,
                'bannerfirst'=>$bannerfirst,
                'bannerrest'=>$bannerrest,
                'review'=>$reviewarr
        ]); 
    }

    public function modalcontent($id)
    {
        echo "AA";
    }
}
