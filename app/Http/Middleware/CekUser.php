<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$rules)
    {
        if(!Auth::check()){
            return redirect('login');
        }

        $user = Auth::user();
        if($user->hak_akses_id === $rules)
            return $next($request);     
            return redirect('login')->with ('error',"Kamu Tidak Memiliki Akses");
    }
}
