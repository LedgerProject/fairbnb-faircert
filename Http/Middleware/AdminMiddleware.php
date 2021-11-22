<?php

namespace Modules\Ledger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    
        $user_role = $request->user()->roles->toArray();
        //echo $user_role[0]['name'];die;

        switch ($user_role[0]['name']) {
            case 'Admin':
                return redirect('admin/dashboard');
                break;

            case 'Host':
                return redirect('host/dashboard');
                break;

            case 'Customer':
                return redirect('customer/dashboard');
                break;

            case 'Ambassador':
                return redirect('ledger/dashboard');
               // return redirect()->route('ledger.dashboard');
                break;

            default:
                return redirect('login');
                break;
        }
        return $next($request);
    }
}
