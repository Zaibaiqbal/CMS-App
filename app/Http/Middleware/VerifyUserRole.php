<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check()) {
            $user = \Auth::user();

            $roles = $user->userRoles->pluck('name')->toArray();

            if (in_array('Client',$roles)) {

                
                    return redirect('clientdashboard');
            
            }
            elseif(in_array('Super Admin',$roles))
            {

                return redirect('/home');

            }
         
        }

        return $next($request);
    }
}
