<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Career;
//use App\Models\User;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        //dd("A");
    	$career = Career::where('status',1)->orderBy('id','DESC')->get();

        $data['users'] = $career;
        
        return view('admin.career.index',$data);
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


}
