<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Userlavel;
use App\Models\Aum;
use App\Models\Earning;
use DB;
use Redirect;
use App\Helper\general;
use App\Traits\UserHelper;
//use App\Models\Aum;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;

class ActivateController extends Controller
{
    use UserHelper; 
    public function index(Request $request)
    {
        //dd("A");
    	$users = User::where('status',1)->where('deleted',0)->where('id_role','!=',1)->get();
        $user_arr=[];
        foreach($users as $user)
        {
            $aum=Aum::where('user_id',$user->name)->first();
            $amount=0;
            $amount_display=0;
            if($aum)
            {
                $amount=$aum->amount;
                $amount_display=$aum->amount_display;
            }
            $photo=url('public/user.jpg');
            if(file_exists(public_path('uploads/users/'.$user->photo)) && $user->photo!=''){
                $photo=url('public/uploads/users/'.$user->photo);
            }
            
            $user_arr[]=[
                'id'=>$user->id,
                'first_name'=>$user->first_name,
                'middle_name'=>$user->middle_name,
                'last_name'=>$user->last_name,
                'name'=>$user->name,
                'pan'=>$user->pan,
                'email'=>$user->email,
                'mobile'=>$user->mobile,
                'photo'=>$photo,
                'nama_role'=>$user->id_role,
                'activate'=>$user->activate,
                'amount'=>$amount,
                'amount_display'=>$amount_display,
            ];
        }

        $data['users'] = $user_arr;
        
        return view('admin.activate.index',$data);
    }

    public function edit($parent_code)
    {
        $users = User::where('name',$parent_code)->first();
        
        $aum=Aum::where('user_id',$users->name)->first();
        if(!$aum)
        {
            $amount=0;
            $amount_display='';
        }
        else
        {
            $amount=$aum->amount;
            $amount_display=$aum->amount_display;
        }
        $data=[
            'id'=>$users->id,
            'first_name'=>$users->first_name,
            'last_name'=>$users->last_name,
            'name'=>$users->name,
            'pan'=>$users->pan,
            'email'=>$users->email,
            'mobile'=>$users->mobile,
            'email'=>$users->email,
            'activate'=>$users->activate,
            'amount'=>$amount,
            'amount_display'=>$amount_display,
            /*'first_name'=>$users->first_name,
            'first_name'=>$users->first_name,
            'first_name'=>$users->first_name,
            'first_name'=>$users->first_name,
            'first_name'=>$users->first_name,
            'first_name'=>$users->first_name,
            'first_name'=>$users->first_name,*/
        ];
        //dd($data);
        return view('admin.activate.edit-user',[
            //'parent_code'=>$parent_code." (".$name.")",
           // 'parent_id'=>$users->id,
            'data'=>$data,
        ]);
    }

    public function updateuser(Request $request)
    {
        $input=$request->all();
        $parent_id=$input['parent_id'];
        $parent_code=$input['parent_code'];
       
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pan' => 'required|string|max:255',
           // 'password' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('admin/activate/edit-user/'.$parent_code)
                ->withErrors($validator)
                ->withInput();

        }
       
        $first_name=trim($input['first_name']);
        $last_name=trim($input['last_name']);
        $email=trim($input['email']);
        $pan=strtoupper(strtolower(trim($input['pan'])));
        $activate=$input['activate'];
        $mobile=$input['mobile'];        
        if($input['amount']>0)
        {
            $amount=$input['amount'];
            $amount_display=$input['amount_display'];
            if($amount_display)
            {
                $amount_display=$input['amount_display'];
            }
            else
            {
                if($amount>99999)
                {
                    $amount_display=($amount/100000).'GB';
                }
                else
                {
                    $amount_display=($amount/1000).'MB';
                }
            }
            
        }
        else
        {
            $amount=0;
            $amount_display='';
        }
        DB::beginTransaction();
        try {
            User::where('name', $parent_code)->where('id', $parent_id)->update([
                'first_name'    => $first_name,
                'last_name'    => $last_name,
                'pan'    => $pan,
                'email'    => $email,
                'mobile'    => $mobile,
                'activate'    => $activate,
            ]);

            Aum::where('user_id', $parent_code)->update([
                'amount'    => $amount,
                'amount_display'    => $amount_display
            ]);

            DB::commit();

             return Redirect::to('admin/activate')->with('success', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
           
           return Redirect::to('admin/activate/add-user/'.$parent_code)->with('error', $msg);
        }
    }

    public function addUser($parent_code)
    {
        $users = User::where('name',$parent_code)->first();
        $name='';
        if(!empty($users))
        {
            $name=$users->first_name.' '.$users->last_name;
        }
        return view('admin.activate.add-user',[
            'parent_code'=>$parent_code." (".$name.")",
            'parent_id'=>$users->id,
            'parent_code_only'=>$parent_code,
        ]);
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $parent_code=$input['parent_code_only'];
       
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pan' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('admin/activate/add-user/'.$parent_code)
                ->withErrors($validator)
                ->withInput();

        }
       
        $first_name=trim($input['first_name']);
        $last_name=trim($input['last_name']);
        //$full_name=$first_name.' '.$last_name;
        $name=$this->generateUser($first_name,$last_name);
        //dd($name);
        $pan=strtoupper(strtolower(trim($input['pan'])));
        $activate=$input['activate'];
        $mobile=$input['mobile'];        
        $password=Hash::make($input['password']);
        $id_role=2;
        $userId=$input['parent_id'];
        $amount=0;
        $amount_display=0;
        if($input['amount']>0)
        {
            $amount=$input['amount'];
            if($amount_display)
            {
                $amount_display=$input['amount_display'];
            }
            else
            {
                if($amount>99999)
                {
                    $amount_display=($amount/100000).'GB';
                }
                else
                {
                    $amount_display=($amount/1000).'MB';
                }
            }
            
        }
        
        $userName=session()->get('username');
        $depth=general::getNextDepth($parent_code);
        //dd($activate);
        DB::beginTransaction();
        try {
            $users = new User();
            $users->name=$name;
            $users->first_name=$first_name;
            $users->last_name=$last_name;
            $users->pan=$pan;
            $users->password=$password;
            $users->mobile=$mobile;
            $users->id_role=$id_role;
            $users->status=1;
            $users->activate=$activate;
            $users->deleted=0;
            $users->save();
            
            $uerlavel = new Userlavel();
            $uerlavel->title=$name;
            $uerlavel->depth=$depth;
            $uerlavel->parent_id=$userId;
            $uerlavel->status=1;
            $uerlavel->deleted=0;
            $uerlavel->save();

            if($amount>0)
            {                
                $aum = new Aum();
                $aum->user_id=$name;
                $aum->month=date("m");
                $aum->amount=$amount;
                $aum->amount_display=$amount_display;
                $aum->paid_on=date("Y-m-d H:i:s");
                $aum->expire_on=date("Y-m-d H:i:s");
                $aum->status=1;
                $aum->deleted=0;
                $aum->save();
            }
            

            DB::commit();

             return Redirect::to('admin/activate')->with('success', 'Data added successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
           
           return Redirect::to('admin/activate/add-user/'.$parent_code)->with('error', $msg);
        }
    }

    public function deleteUser($code)
    {
        DB::beginTransaction();
        try {
            User::where('name', $code)->update([
                'status'    => 0,
                'deleted'    => 1
            ]); 

            Userlavel::where('title', $code)->update([
                'status'    => 0,
                'deleted'    => 1
            ]); 

            Aum::where('user_id', $code)->update([
                'status'    => 0,
                'deleted'    => 1
            ]);

            Earning::where('user_id', $code)->update([
                'status'    => 0,
                'deleted'    => 1
            ]); 
            DB::commit();

             return Redirect::to('admin/activate')->with('success', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
            return Redirect::to('admin/activate')->with('error', $msg);
        }
    }

    public function userImage($user_code){
        $users = User::where('name',$user_code)->first();
        $name='';
        if(!empty($users))
        {
            $name=$users->first_name.' '.$users->last_name;
        }
        return view('admin.activate.user-image',[
            'parent_code'=>$user_code." (".$name.")",
            'parent_id'=>$users->id,
            'parent_code_only'=>$user_code,
        ]);
    }

    public function updateImage(Request $request)
    {        
        $input=$request->all();
       // dd($input);
        $user_code=$input['user_code'];
        //$first_name=$input['first_name'];
        //$last_name=$input['last_name'];
        //$mobile=$input['mobile'];
        /*$validator = Validator::make($request->all(), [
            //'first_name' => 'required|string|max:255',
            //'last_name' => 'required|string|max:255',
            'upload_image' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/activate/image/'.$user_code)->with('error', 'Please fill all required data.');
        }*/
        
        
       // dd("P");
        
        
        
       // dd($input);
        DB::beginTransaction();
        try {

           if (isset($request->upload_image) && $request->upload_image!=null) {
            //dd("X");
                $image = $request->upload_image;
                list($type, $image) = explode(';', $image);
                list(, $image)      = explode(',', $image);
                $image = base64_decode($image);
                $image_name = time().'.png';
                $path = 'public/uploads/users/'.$image_name;
                //dd($path);
                file_put_contents($path, $image);
                User::where('name', $user_code)->update([
                    'photo'    => $image_name,
                ]);
                /*$file = $request->file('image');
                $file_ext = $file->clientExtension();
                $filename = 'user-'.time().rand(1,9999).'.'.$file_ext; 
                $upload_path = 'public/uploads/users/';      
                $image_name=imagehelper::upload($file,$filename,$upload_path,'user');
                Users::where('name', $parent_code)->update([
                    'photo'    => $image_name,
                ]); */
            }
            DB::commit();

             return Redirect::to('admin/activate')->with('success', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
           return Redirect::to('admin/activate/image/'.$user_code)->with('error', $msg);
        }
    }

}
