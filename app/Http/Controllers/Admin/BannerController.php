<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use DB;
use Redirect;
//use App\Models\User;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        //dd("A");
    	$career = Banner::where('status',1)->orderBy('id','ASC')->get();

        $data['users'] = $career;
        
        return view('admin.banner.index',$data);
    }

    /*public function create(Request $request)
    {
    	$roles = Role::get(); 
        $data['roles'] = $roles;
        
        return view ('admin.users.create',$data);
    }*/

    public function edit(Request $request,$id)
    {
    	$user = Banner::findOrFail($id);

        $data['user'] = $user;
        
       // $roles = Role::get();
      //  $data['roles'] = $roles;
    	return view ('admin.banner.edit',$data);
    }

    /*public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('photo')) {
            $request->file('photo')->move('uploads/', $request->file('photo')->getClientOriginalName());
            $user->photo = $request->file('photo')->getClientOriginalName();
        }

        $user->save();

    	return redirect('admin/user')->with('success','Data Berhasil di Simpan');
    }*/

    public function update(Request $request,$id)
    {
        $input=$request->all();
        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/banner/list')->with('error', 'Please fill all required data.');
           // return response()->json(['success' => 'false', 'msg' => 'Invalid value.', 'errorcode' => '404']);
        }
        $heading=$input['heading'];
        $description=$input['description'];
        //dd($description);
        $banner = Banner::findOrFail($id);
        $banner->heading = $heading;
        $banner->description = $description;
        //$banner->id_role = $request->id_role;
        /*if(!empty($request->password)) {
            $banner->password = bcrypt($request->password);
        }*/

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $file_ext = $file->clientExtension();
            $filename = 'user-'.time().rand(1,9999).'.'.$file_ext; 

            $request->file('photo')->move('public/uploads/banner/', $filename);
            $banner->image = $filename;
        }
        
        $banner->save();

    	return redirect('admin/banner/list')->with('success','Data Berhasil di Simpan');
    }

    public function delete(Request $request, $id)
    {
    	$user = User::findOrFail($id);
    	$user->delete();

    	return redirect('admin/user')->with('success','Data Berhasil di Hapus');
    }


}
