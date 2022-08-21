<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\UserHelper;
use App\Models\Users;
use App\Models\Userlavel;
use App\Models\Profession;
use App\Category;
use App\Models\Review;
use App\Helper\imagehelper;
use Hash;
use DB;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Helper\general;

class UserController extends Controller
{
    use UserHelper; 
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
        $page['heading']="login";
        $page['title']="Login";
        $arr=[];
        return view('user.login',['data'=>$arr, 'page'=>$page]); 
    }

    public function register()
    {
        $page['heading']="register";
        $page['title']="Register";
        $arr=[];
        return view('user.register',['data'=>$arr, 'page'=>$page]); 
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pan' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return Redirect::to('user/register')->with('error', 'Please fill all required data.');
           // return response()->json(['success' => 'false', 'msg' => 'Invalid value.', 'errorcode' => '404']);
        }
        //dd("P");
        $name=$this->generateUsername();
        $first_name=$input['first_name'];
       // $middle_name=$input['middle_name'];
        $last_name=$input['last_name'];
        $pan=$input['pan'];
        $mobile=$input['mobile'];
        $parent_code=$input['parent_code'];
        $password=Hash::make($input['password']);
        $id_role=2;
        $userId=Auth::User()->id;
        $userName=session()->get('username');
        $depth=general::getNextDepth($parent_code);
        //dd($depth);
        //dd($parent_code);
        /*$totalChild=$this->getChildCount();
        if ($totalChild >= 5) {
            return Redirect::to('user/register')->with('error', 'Maximum child added.');
           // return response()->json(['success' => 'false', 'msg' => 'Invalid value.', 'errorcode' => '404']);
        }*/
        DB::beginTransaction();
        try {
            $users = new Users();
            $users->name=$name;
            $users->first_name=$first_name;
           // $users->middle_name=$middle_name;
            $users->last_name=$last_name;
            $users->pan=$pan;
            $users->password=$password;
            $users->mobile=$mobile;
            $users->id_role=$id_role;
            $users->status=1;
            $users->deleted=0;
            $users->save();
            
            $uerlavel = new Userlavel();
            $uerlavel->title=$name;
            $uerlavel->depth=$depth;
            $uerlavel->parent_id=$userId;
            $uerlavel->status=1;
            $uerlavel->deleted=0;
            $uerlavel->save();

            //dd($parent_code);
            DB::commit();

             return Redirect::to('user/register')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
           //dd($e->getCode());
            return Redirect::to('user/register')->with('error', $msg);
        }
    }

    public function doLogin(Request $request)
    {
        //dd("P");
       // $helpers=new helpers;
        $username = Input::get('username');
        //$username = 'amypc3044l';
        //$username = Input::get('email');
        $password = Input::get('password');
       // $password = '123456';
      // dd($username,$password);
       // $remember = (Input::has('remember')) ? true : false;
        $remember=false;
        
        $auth = Auth::attempt(
                    [
                        'name'  => $username,
                        'password'  => $password,
                        'id_role'  => '2',                 
                        'status'  => '1'   
                    ], $remember
                );  
      //  dd(Auth::user()->name);
        //dd($password);
       // dd($auth);
        if ($auth) {
            if(Auth::check())
            {
                //KLPS0000021419
                //if(Auth::user()->account_type=="1")
                //{
                //dd("M");
                    session()->put('username', $username);
                    //session()->put('email', $users->email);
                    session()->put('role', 2);
                   return Redirect::to('user/listing');  
                //}                
                //else
                //{
                //   return Redirect::to('/customer/dashboard');
                    
                //}               
            }           
        }
        else
        {
            return Redirect::back()
            ->withInput()->with('error', 'Incorrect Username or Password');
        }
    }

    public function logout()
    {
        session()->forget('username');
        session()->forget('role');

        Auth::logout();     
            return Redirect::to('user/login')
            ->withInput()
            ->with('message', 'You have logout successfully.');
    }

    public function listing()
    {
        $userId=Auth::User()->id;
        $userCode=Auth::User()->name;
        //dd($userCode);
    }

    public function showListing()
    {
        //dd("a");
        //$totalChild=$this->getChildCount();
        $userId=Auth::User()->id;
        $userCode=Auth::User()->name;
        //dd($userId);
        $lastId=$this->getPrevParent($userCode);
        //dd($lastId);
        $categories = Userlavel::where('id', '=', $lastId)->get();
       // $categories = Userlavel::where('parent_id', '=', 0)->get();
       // dd($categories->toArray());
        $allCategories = Userlavel::pluck('id','title')->all();
        //$allCategories = Userlavel::all();
       // dd($allCategories->toArray());

        $users=Users::where('name',$userCode)->first();
        $photo=url('public/user.jpg');
        if(!empty($users->photo))
        {
            $photo=url('public/uploads/users/'.$users->photo);
        }
        $page['heading']="user-listing";
        $page['title']="User Listing";
        $arr=[
            //'image'=>'<img class="img-thumbnail" width="200" src="../public/uploads/1.jpg" />',
            'image'=>$photo,
            'name'=>$users->first_name.' '.$users->last_name,
            'pan'=>$users->pan,
            'phone'=>$users->mobile,
        ];
        return view('categoryTreeview',compact('categories','allCategories','page','arr'));
    }


    public function profile()
    {
        $userCode=Auth::User()->name;
        //$userCode='vv';
        $users=Users::where('name',$userCode)->first();
        $arr=[];
        if($users)
        {
            $arr=$users;
        }
        
        $page['heading']="my-profile";
        $page['title']="My Profile";
        
        return view('user.profile',['data'=>$arr, 'page'=>$page]); 
    }

    public function review()
    {
        $userCode=Auth::User()->name;
        $professions=Profession::where('status',1)->orderBy('title','ASC')->get();
        
        $review=Review::where('user_code',$userCode)->get();
        $page['button']="Add Review";
        $arr=[
            'update'=>0,
            'description'=>'',
            'profession'=>'',
        ];
        if(count($review)>0)
        {
            $page['button']="Update Review";
            $arr=[
                'update'=>1,
                'description'=>$review[0]->description,
                'profession'=>$review[0]->profession,
            ];
        }
        //dd($arr);
        $page['heading']="my-review";
        $page['title']="My Review";
        
        return view('user.review',['data'=>$arr, 'page'=>$page,'professions'=>$professions]); 
    }

    public function addreview(Request $request)
    {
        $userCode=Auth::User()->name;
        $provide_by=Auth::User()->id;
        $parent_code = Input::get('parent_code');
        $profession = Input::get('profession');
        $description = Input::get('description');
        $update = Input::get('update');
        if($update==0)
        {
            DB::beginTransaction();
            try {
                $review = new Review();
                $review->user_code=$parent_code;
                $review->profession=$profession;
                $review->description=$description;
                $review->provide_by=$provide_by;
                $review->status=1;
                $review->deleted=0;
                $review->save();

                DB::commit();

                 return Redirect::to('user/review')->with('message', 'Review added successfully.');
            }catch (\Exception $e) {                
               DB::rollback();
               $msg="Some error occoured! Please try again.";
               if($e->getCode()==23000)
               {
                $msg=$e->errorInfo[2];
               }
               //dd($e->getCode());
                return Redirect::to('user/review')->with('error', $msg);
            }
        }
        else
        {
            Review::where('user_code', $parent_code)->update([
                'profession'    => $profession,
                'description'    => $description
            ]);
            return Redirect::to('user/review')->with('message', 'Review updated successfully.');
        }
    }

    public function updateprofile(Request $request)
    {
        $input=$request->all();

        $parent_code=$input['parent_code'];
        $first_name=$input['first_name'];
        $last_name=$input['last_name'];
        $mobile=$input['mobile'];

        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_ext = $file->clientExtension();
            $filename = 'user-'.time().rand(1,9999).'.'.$file_ext; 
            $upload_path = 'public/uploads/users/';      
            $image_name=imagehelper::upload($file,$filename,$upload_path,'user');
            Users::where('name', $parent_code)->update([
                'photo'    => $image_name,
            ]); 
        }
        //dd("P");
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pan' => 'required|string|max:255',
            'parent_code' => 'required|string|max:255',
            'mobile' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return Redirect::to('user/profile')->with('error', 'Please fill all required data.');
        }
        
        
        
        DB::beginTransaction();
        try {

            Users::where('name', $parent_code)->update([
                'first_name'    => $first_name,
                'last_name'    => $last_name,
                'mobile'    => $mobile,
                //'photo'    => $image_name,
            ]); 
            DB::commit();

             return Redirect::to('user/profile')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
           return Redirect::to('user/profile')->with('error', $msg);
        }
    }
}
