<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class loginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('token')) {
            $request->session()->flush();
            return redirect()->route('login.process');
        }else{
            $userToken = lock(session('token'), 'decrypt');
            $user = Employee::find($userToken);
            if(! empty($user)){
                if($user->employee_status != 'active'){
                    $request->session()->flush();
                    return Redirect::route('login.process')->with('error', 'User account is inactive. Please contact our executive.')->withInput();
                }
            }
        }

        return $next($request);
    }
}
