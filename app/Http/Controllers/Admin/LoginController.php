<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    public function validation(Request $request)
    {
		//dd($request->username);
		//$password = Hash::make($request->password);
		//dd($password);
        $users = Users::where('name',$request->username)->first();
		//dd($request->all());
        if (!empty($users) && Hash::check($request->password, $users->password)) {
            session()->put('username', $users->name);
            session()->put('email', $users->email);
            session()->put('role', $users->id_role);
            return redirect('/admin/dashboard');
        } else {
            return redirect()->back()->with('gagal', 'invalid Username and Password'); 
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('admin/login');
    }
}
