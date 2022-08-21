<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\UserHelper;
use App\Models\Users;
use App\Models\Userlavel;
use App\Models\Profession;
use App\Category;
use App\Models\Review;
use App\Models\Earning;
use App\Helper\imagehelper;
use Hash;
use DB;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Helper\general;
use App\Models\Aum;

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
        $first_name=$input['first_name'];
        $last_name=$input['last_name'];
        $name=$this->generateUser($first_name,$last_name);
        
       // $middle_name=$input['middle_name'];
        
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
        $userId=Auth::User()->id;
        $userCode=Auth::User()->name;
        $lastId=$this->getPrevParent($userCode);
        $categories = Userlavel::where('id', '=', $lastId)->get();
        $allCategories = Userlavel::pluck('id','title')->all();
        

        $users=Users::where('name',$userCode)->first();
        $photo=url('public/user.jpg');
        if(!empty($users->photo))
        {
            $photo=url('public/uploads/users/'.$users->photo);
        }
        $page['heading']="user-listing";
        $page['title']="User Listing";
        $aum=Aum::where('user_id',$userCode)->orderBy('id','DESC')->first();
        //dd($aum->toArray());
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
            'name'=>$users->first_name.' '.$users->last_name,
            'pan'=>general::maskedPan($users->pan),
            'phone'=>general::maskedPan($users->mobile),
            'amount'=>$amount,
            'amount_display'=>$amount_display,
            'activate'=>$users->activate,
            'color'=>$color,
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
        
        /*list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        //dd($image_name);
        $path = public_path('upload/'.$image_name);

        //file_put_contents($path, $image);

       // dd("XX");

        $b64 = $image;

        // Obtain the original content (usually binary data)
        $bin = base64_decode($b64);

        // Load GD resource from binary data
        $im = imageCreateFromString($bin);

        // Make sure that the GD library was able to load the image
        // This is important, because you should not miss corrupted or unsupported images
        if (!$im) {
          die('Base64 value is not a valid image');
        }

        // Specify the location where you want to save the image
        $img_file = $path;
        imagepng($im, $img_file, 0);
        dd($img_file);*/
       // dd($image);
        $input=$request->all();
        //dd($input);
        $parent_code=$input['parent_code'];
        $first_name=$input['first_name'];
        $last_name=$input['last_name'];
        $mobile=$input['mobile'];

        
        if (isset($request->upload_image) && $request->upload_image!=null) {
           // dd("X");
            $image = $request->upload_image;
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            $image_name = time().'.png';
            $path = 'public/uploads/users/'.$image_name;
            //dd($path);
            file_put_contents($path, $image);
            Users::where('name', $parent_code)->update([
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
       // dd("P");
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
        
        
       // dd($input);
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

    public function showEarning(){
        $user_code=Auth::User()->name;
        //dd($user_code);
        $earning=Earning::where('user_id',$user_code)->where('status',1)->where('deleted',0)->orderBy('id','DESC')->get();
        //dd($earning->toArray());
        $page['heading']="earning";
        $page['title']="Earning";
        $arr=[];
        $total=0;
        $sl=0;
        //dd(count($earning));
       // if($earning)
        //{
            //dd("A00");
            foreach($earning as $data)
            {
                if($data->amount >0)
                {
                    $sl=$sl+1;
                    $total=$total+$data->amount;
                    $arr[]=[
                        'sl'=>$sl,
                        'month'=>date('F', mktime(0, 0, 0, $data->month, 10)),
                        'year'=>$data->year,
                        'amount'=>number_format($data->amount,2)
                    ]; 
                }
                
            }
        //}
        //else
        //{
        //    $arr=[];
        //}
        
        //$arr['total'][]=$total;
        //dd($arr);
        return view('user.earning',['data'=>$arr,'total'=>number_format($total,2), 'page'=>$page]); 
    }
}
