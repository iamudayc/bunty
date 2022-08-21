<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\serviceHelper;

use App\Models\Market;

class ServicesController extends Controller
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
        $market=Market::where('status',1)->orderBy('id','ASC')->get();
        //dd($market->toArray());
        $mkt_arr=[];
        foreach($market as $details)
        {
            if($details->changeval >0)
            {
                $colorclass='green';
                $arrowclass='<i class="bi bi-caret-up-fill green" ></i>';
            }
            elseif($details->changeval <0)
            {
                $colorclass='red';
                $arrowclass='<i class="bi bi-caret-down-fill red" ></i>';
            }
            else
            {
                $colorclass='black';
                $arrowclass='<i class="bi bi-caret-left-fill black" ></i><i class="bi bi-caret-right-fill green" ></i>';
            }
            $mkt_arr[]=[
                'title'=>$details->title,
                'curvalue'=>$details->curvalue,
                'changeval'=>$details->changeval,
                'changeper'=>$details->changeper,
                'colorclass'=>$colorclass,
                'arrowclass'=>$arrowclass,
            ];
        }
        //dd($mkt_arr);
        //dd(serviceHelper::getService('PAGE_HEADING')->value);
        $page['heading']="services";
        $page['title']="Services";
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
        return view('services',['data'=>$arr, 'page'=>$page,'mkt_arr'=>$mkt_arr]); 
    }
}
