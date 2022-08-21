<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Users;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       // dd("P");
        //dd(session('username'));
        $users = Users::where('name',session('username'))->first();
        if(!empty($users) && $users->id_role == 2){
          //  dd("M");
            return $next($request);
        } else {
            //dd("U");
            abort('403');
        }
    }
}
