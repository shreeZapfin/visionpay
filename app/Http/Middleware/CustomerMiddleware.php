<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user()->user_type_id == UserType::Customer) {
            return $next($request);
        } else {
            return redirect('/login')
                ->with('status', 'Invalid login');
        }
    }
}
