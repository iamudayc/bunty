<?php 
 namespace App\Traits;

 use App\Models\Users;
 use App\Models\Userlavel;

 trait UserHelper
 {
      public function generateUser($first_name,$last_name)     
      {  
         $get_first = substr(strtolower(trim($first_name)), 0, 2);
         $get_last = substr(strtolower(trim($last_name)), 0, 2);
         $static=strtoupper($get_first.$get_last);
         //dd($static);
         $num = $this->recentUserId();
         $num_padded = sprintf("%04d", $num);
         //$userId=$static.$num_padded.rand(10,99).rand(12,90);
         $userId=$static.$num_padded;
         //$userId="SKAM0010";
         $chk=$this->checkUnique($userId);
         if($chk >0)
         {
            $user_name="KLPS".$num_padded;
         }
         else
         {
            $user_name=$userId;
         }
         //dd($user_name);
         return $user_name;  
      }

      /*public function generateUsername($static="KLPS")     
      {  

         $num = $this->recentUserId();
         $num_padded = sprintf("%04d", $num);
         //$userId=$static.$num_padded.rand(10,99).rand(12,90);

         $userId=$static.$num_padded;
         
         
         return $userId;  
      }*/

      public function checkUnique($static)     
      {  
         //dd($static);
         $users=Users::where('name',$static)->count();
         //dd($users);
         return $users;
         /*$num = $this->recentUserId();
         $num_padded = sprintf("%04d", $num);
         //$userId=$static.$num_padded.rand(10,99).rand(12,90);
         $userId=$static.$num_padded;
         dd($static);
         return $userId; */ 
      }

     public function generatePassword($static="KLPS")     
     {  

        $num = $this->recentUserId();
        $num_padded = sprintf("%03d", $num);
        //$userId=$static.$num_padded.rand(10,99).rand(12,90);
        $userId=$static.$num_padded;
       //  dd($userId);
        return $userId;  
     }

     public function recentUserId()     
     {               
        $lastId=Users::orderBy('id','desc')->pluck('id')->first();
        $nextId=$lastId+1;

        return $nextId;  
     }

     public function getPrevParent($title)     
     {         
     // dd($title);      
        $topId=Userlavel::where('title',$title)->pluck('id')->first();

        $lastId=Userlavel::where('id',$topId)->pluck('id')->first();
        //$nextId=$lastId+1;
        //dd($topId);
        return $lastId;  
     }

     public function getChildCount()     
     {         
        $userName=session()->get('username');
        //dd($parent_code);
        //dd($userName);    
        $topId=Userlavel::where('title',$userName)->pluck('id')->first();
        //dd($topId);
        $count=Userlavel::where('parent_id',$topId)->count();
        //$nextId=$lastId+1;
        //dd($count);
        return $count;  
     }
     
 }   