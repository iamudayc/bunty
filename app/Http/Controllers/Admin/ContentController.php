<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Role;
//use App\Models\User;
use App\Models\Service;
use App\Models\Sitesetting;
use DB;
use Redirect;

class ContentController extends Controller
{
    public function service()
    {
        //dd("service");
    	$service = Service::where('status',1)->orderBy('display_order','ASC')->get();
       // dd($service->toArray());
        $data['services'] = $service;
        
        return view('admin.content.service.index',$data);
    }

    public function create(Request $request)
    {
    	$roles = Role::get(); 
        $data['roles'] = $roles;
        
        return view ('admin.users.create',$data);
    }

    public function edit(Request $request,$id)
    {
    	$user = User::select(
            'users.*',
            'users.id as id_user',
            'role.*',
            'role.nama as nama_role'
        )
        ->leftjoin('role','role.id','users.id_role')
        ->findOrFail($id);

        $data['user'] = $user;
        
        $roles = Role::get();
        $data['roles'] = $roles;
    	return view ('admin.users.edit',$data);
    }

    public function store(Request $request)
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
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        if(!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            $request->file('photo')->move('uploads/', $request->file('photo')->getClientOriginalName());
            $user->photo = $request->file('photo')->getClientOriginalName();
        }
        
        $user->save();

    	return redirect('admin/user')->with('success','Data Berhasil di Simpan');
    }

    public function delete(Request $request, $id)
    {
    	$user = User::findOrFail($id);
    	$user->delete();

    	return redirect('admin/user')->with('success','Data Berhasil di Hapus');
    }

    public function editservice($id)
    {
       // dd($id);
        $service = Service::where('id',$id)->first();
       // dd($service->toArray());
        $data['services'] = $service;
        
        return view('admin.content.service.edit',['data'=>$data]);

        //return redirect('admin/user')->with('success','Data Berhasil di Hapus');
    }

    public function updateservice(Request $request)
    {
        $input=$request->all();
        $value=$input['value'];
        $id=$input['id'];
        

        DB::beginTransaction();
        try {
            Service::where('id', $id)->update([
                'value'    => $value
            ]); 
            DB::commit();

             return Redirect::to('admin/content/services')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
            return Redirect::to('admin/content/services')->with('error', $msg);
        }
    }

    public function sitesettingslist()
    {
        //dd("service");
        $sitesetting = Sitesetting::where('status',1)->orderBy('display_order','ASC')->get();
        //dd($sitesetting->toArray());
        $data['services'] = $sitesetting;
        
        return view('admin.content.site_settings.index',$data);
    }

    public function editsitesettings($id)
    {
       // dd($id);
        $sitesetting = Sitesetting::where('id',$id)->first();
       // dd($service->toArray());
        $data['services'] = $sitesetting;
        
        return view('admin.content.site_settings.edit',['data'=>$data]);

        //return redirect('admin/user')->with('success','Data Berhasil di Hapus');
    }

    public function updatesitesettings(Request $request)
    {
        $input=$request->all();
        $value=$input['value'];
        $id=$input['id'];
        //dd($input);

        DB::beginTransaction();
        try {
            Sitesetting::where('id', $id)->update([
                'value'    => $value
            ]); 
            DB::commit();

             return Redirect::to('admin/content/site/list')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
           DB::rollback();
           $msg="Some error occoured! Please try again.";
           if($e->getCode()==23000)
           {
            $msg=$e->errorInfo[2];
           }
            return Redirect::to('admin/content/site/list')->with('error', $msg);
        }
    }
    


}
