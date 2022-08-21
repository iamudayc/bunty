<?php namespace App\Helper;
use File;
use Intervention\Image\Facades\Image;


ini_set('memory_limit', '-1');


	
class imagehelper  
{    

    public static function upload($originalFile,$filename,$upload_path,$section='user')
    { 
       
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }
        $image_info=(getimagesize($originalFile));
        $image_width=$image_info[0];
        $image_height=$image_info[1];

        $main_size=500;

        if($image_width > $image_height)
        {
            $resize_width=$main_size;
            $resize_height=(int)(($image_height/$image_width)*$resize_width);
        }
        else if($image_width < $image_height)
        {   
            $resize_height=$main_size;         
            $resize_width=(int)(($image_width/$image_height)*$resize_height);            
        }
        else
        {
            $resize_width=$main_size;
            $resize_height=$main_size;
        }

        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit($resize_width, $resize_height, function ($constraint) {
        $constraint->upsize();
        })->save($upload_path . $filename);

        return $filename;
    }
    
}

?>