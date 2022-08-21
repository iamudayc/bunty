<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Earning;
use App\Helper\general;
use DB;
use Redirect;

class EarningController extends Controller
{
    public function index(Request $request)
    {
    	$users = User::select(
            'users.*',
            'role.*',
            'role.nama as nama_role',
            'users.id as id_user'
        )
        ->leftjoin('role','role.id','users.id_role')
        ->where('id_role',2)
        ->where('deleted',0)
        ->get();

        $data['users'] = $users;
        
        return view('admin.earning.index',$data);
    }

    public function updateearning()
    {
        $months=[
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December',
        ];
        $data['months'] = $months;
        return view ('admin.earning.edit',$data);
    }

    public function store(Request $request)
    {
        //dd("A");
        /*$user = new User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('photo')) {
            $request->file('photo')->move('uploads/', $request->file('photo')->getClientOriginalName());
            $user->photo = $request->file('photo')->getClientOriginalName();
        }

        $user->save();

        return redirect('admin/user')->with('success','Data Berhasil di Simpan');*/
        //dd($request->month);
        $updatemonth=$request->month;
        //dd($updatemonth);
        $file = $request->file('earning');

        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        $uploaded_filename=time().rand(0,1).".".$extension;
        // Valid File Extensions
        $valid_extension = array("csv");

        // 20MB in Bytes
        $maxFileSize = 20097152; 
        if(in_array(strtolower($extension),$valid_extension)){

            if($fileSize <= $maxFileSize){
               // dd($extension."P");
                // File upload location
                $location = public_path('uploads/csv');

                // Upload file
                $file->move($location,$uploaded_filename);
                // Import CSV to Database
                $filepath = $location."/".$uploaded_filename;
                //dd($filepath);
                // Reading file
                $file = fopen($filepath,"r");
                //$importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {

                    $num = count($filedata );
                    if($i == 0){
                        $i++;
                        continue; 
                    }
                    for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                    }
                    if(Earning::where('user_id',$filedata [0])->where('month',$updatemonth)->where('year',$request->get('year'))->count()<=0)
                    {
                        $amount=0;
                        if($filedata[2]>=0)
                        {
                            $amount=$filedata [2];
                        }
                        $earning = new Earning;
                        $earning->user_id = $filedata[0];
                        $earning->month = $updatemonth;
                        $earning->year = $request->get('year');
                        $earning->amount = $amount;
                        $earning->paid_on = date("Y-m-d");
                        $earning->status = 1;
                        $earning->deleted = 0;
                        $earning->save();

                    }
                    else
                    {
                        return redirect('admin/earnings')->with('error','Data already updated.');
                    }
                    
                    
                    $i++;
                }
                fclose($file);
                return redirect('admin/earnings')->with('success','Data updated successfully');
               // dd($importData_arr);
            }
        }
        // Check file extension
        /*if(in_array(strtolower($extension),$valid_extension)){

            // Check file size
            if($fileSize <= $maxFileSize){

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location,$filename);

                // Import CSV to Database
                $filepath = public_path($location."/".$filename);

                // Reading file
                $file = fopen($filepath,"r");

                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata );

                    // Skip first row (Remove below comment if you want to skip the first row)
                    /*if($i == 0){
                    $i++;
                    continue; 
                    }*/
                    /*for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                    }
                    $i++;
                }
                fclose($file);*/
        //dd($importData_arr);*/

    }

    public function details($username)
    {
        $earning=Earning::where('user_id',$username)->where('status',1)->where('deleted',0)->orderBy('id','DESC')->get();
        $user_data=general::getUser($username);
        $name=$user_data?$user_data['name']:'NA';
        $months=[
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December',
        ];
        $data_arr=[];
        foreach($earning as $data)
        {
            $data_arr[]=[
                'id'=>$data->id,
                'month'=>$data->month,
                'year'=>$data->year,
                'amount'=>($data->amount>0)?$data->amount:0,
            ];
        }
        //dd($data_arr);
        $data['months'] = $months;
        return view ('admin.earning.details',['data_arr'=>$data_arr,'name'=>$name]);
    }

    public function edit($id)
    {
        $data=Earning::where('id',$id)->where('status',1)->where('deleted',0)->first();
        //$user_data=general::getUser($username);
        //$name=$user_data?$user_data['name']:'NA';
        /*$months=[
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December',
        ];*/
        /*$data_arr=[];
        foreach($earning as $data)
        {
            $data_arr[]=[
                'id'=>$data->id,
                'month'=>$data->month,
                'year'=>$data->year,
                'amount'=>($data->amount>0)?$data->amount:0,
            ];
        }*/
        //dd($data_arr);
       // $data['months'] = $months;
        return view ('admin.earning.editsingle',['data'=>$data]);
    }
    public function update(Request $request)
    {
        $input=$request->all();
        $id=$input['id'];
        $user_id=$input['user_id'];
        $amount=$input['amount'];
        //dd($id,$user_id,$amount);
        DB::beginTransaction();
        try {
            Earning::where('id', $id)->where('user_id', $user_id)->update([
                'amount'    => $amount,
            ]);

            DB::commit();

             return Redirect::to('admin/earnings/details/'.$user_id)->with('success', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
           
           return Redirect::to('admin/earnings/details/'.$user_id)->with('error', $msg);
        }
    }

    public function aum()
    {
        $users = User::where('status',1)->where('deleted',0)->where('id_role','!=',1)->get();
        $user_arr=[];
        foreach($users as $user)
        {
            $user_arr[]=[
                'id'=>$user->id,
                'first_name'=>$user->first_name,
                'middle_name'=>$user->middle_name,
                'last_name'=>$user->last_name,
                'name'=>$user->name,
                'pan'=>$user->pan,
                'email'=>$user->email,
                'mobile'=>$user->mobile,
                'photo'=>$user->photo,
                'nama_role'=>$user->id_role,
            ];
        }

        $data['users'] = $user_arr;
        //dd($data);
        return view('admin.earning.aum',$data);
    }
}
