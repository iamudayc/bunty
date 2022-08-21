<?php 
 namespace App\Helper;

 use App\Models\Users;
 use App\Models\Market;
 use App\Models\Userlavel;
 use App\Models\Gallery;
 use App\Models\Earning;
 use App\Models\Aum;

 class general
 {     
     public static function getChildCount($userName)     
     {         
        
        //dd($parent_code);
       // dd($userName);    
        $topId=Userlavel::where('title',$userName)->pluck('id')->first();
        //dd($userName,$topId);
        $count=Userlavel::where('parent_id',$topId)->count();
        //$nextId=$lastId+1;
        //dd($count);
        return $count;  
     }

     public static function getUser($userName)     
     { 
        $users=Users::where('name',$userName)->first();
        $photo=url('public/user.jpg');
        if(!empty($users->photo) && (file_exists('public/uploads/users/'.$users->photo)))
        {
            $photo=url('public/uploads/users/'.$users->photo);
        }
        $aum=Aum::where('user_id',$userName)->orderBy('id','DESC')->first();
        $amount_display=0;
        $mon="N/A";
        $amount=0;
        if($aum)
        {
            if($aum->month=="01")
            {
                $mon="Jan";
            }
            elseif($aum->month=="02")
            {
                $mon="Feb";
            }
            elseif($aum->month=="03")
            {
                $mon="Mar";
            }
            elseif($aum->month=="04")
            {
                $mon="Apr";
            }
            elseif($aum->month=="05")
            {
                $mon="May";
            }
            elseif($aum->month=="06")
            {
                $mon="Jun";
            }
            elseif($aum->month=="07")
            {
                $mon="Jul";
            }
            elseif($aum->month=="08")
            {
                $mon="Aug";
            }
            elseif($aum->month=="09")
            {
                $mon="Sep";
            }
            elseif($aum->month=="10")
            {
                $mon="Oct";
            }
            elseif($aum->month=="11")
            {
                $mon="Nov";
            }
            elseif($aum->month=="12")
            {
                $mon="Dec";
            }
            else
            {
                $mon="N/A";
            }
            $amount_display=$aum->amount_display;
            $amount=$aum->amount;
        }
        if($users->activate==0)
        {
            $color="#ff0000";
        }
        else
        {
            $color="#2ac143";
        }
        $arr=[
            'image'=>$photo,
            'name'=>$users->first_name.' '.$users->middle_name.' '.$users->last_name,
            'pan'=>general::maskedPan($users->pan),
            'phone'=>general::maskedPan($users->mobile),
            'amount'=>$amount,
            'amount_display'=>$amount_display,
            'activate'=>$users->activate,
            'color'=>$color,
        ]; 

        return $arr;
     }

     public static function footerGallery()     
     {         
        
        $gallery=Gallery::where('status',1)->where('deleted',0)->inRandomOrder()->limit(6)->get();
        $image_name=url('public/user.jpg');
        foreach($gallery as $details)
        {
            if(!empty($details->image_name) && (file_exists('public/uploads/gallery/'.$details->image_name)))
            {
                $image_name=url('public/uploads/gallery/'.$details->image_name);
            }
            
            $arr[]=[
                'image'=>$image_name,
            ]; 
        }
        //dd($arr);
        return $arr;
     }

    public static function livemarket()
    {
        $market=Market::where('status',1)->orderBy('id','ASC')->get();
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
        
        return $mkt_arr; 
    }

    public static function getNextDepth($userName)     
    {    
        $topId=Userlavel::where('title',$userName)->pluck('depth')->first();
        return $topId+1;  
    }

    public static function getDepth($userName)     
    {    
        $topId=Userlavel::where('title',$userName)->pluck('depth')->first();
        return $topId;  
    }

    public static function totalEarning($userName)     
    {  
        //dd($userName);  
        $total=Earning::where('user_id',$userName)->sum('amount');
        $amount=number_format($total,2);
       // dd($total);
        return $amount;  
    }

    public static function maskedPan($pan='ABCDEFGHIJ')     
     {   
        $f_masked="*******".substr($pan, 7)   ;  
        return $f_masked;
        
     }
     
 }   