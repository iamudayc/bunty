<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
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
        $gallery=Gallery::where('status',1)->where('deleted',0)->orderBy('id','DESC')->get();
        $gallery_arr=[];
        $cnt=0;
        foreach($gallery as $details)
        {
            $cnt=$cnt+1;
            $gallery_arr[]=[
                'id'=>$details->id,
                'cnt'=>$cnt,
                'alt'=>$details->image_name,
                'name'=>url('public/uploads/gallery/'.$details->image_name),
                'delay'=>$cnt/10,
            ];
        }
        //dd($gall_arr);
        $page['heading']="Gallery";
        $page['title']="Gallery";
        $arr=$gallery_arr;
        return view('gallery',['data'=>$arr, 'page'=>$page]); 
    }
}
