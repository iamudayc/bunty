<?php 
 namespace App\Helper;

 use App\Models\Service;
 //use App\Models\Userlavel;
 use App\Models\Sitesetting;

 class serviceHelper
 {     
    public static function getService($key)     
    {  
        $service=Service::where('key',$key)->select('value')->first();    

        return $service; 
    }

    public static function getSettings($key)     
    {  
        $service=Sitesetting::where('key',$key)->select('value')->first();    

        return $service; 
    }

     
     
 }   