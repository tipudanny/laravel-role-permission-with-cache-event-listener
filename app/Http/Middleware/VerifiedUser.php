<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifiedUser
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
        $user = User::where('email', $request->input('email'))->first();
        if (empty($user)){
            return response()->json('No User found form this Email Address. Please Register First then Try Again.');
        }
        else if (!empty($user->email_verified_at) && $user->email_verified === true) {
            return $next($request);
        }
        return response()->json('You are not verified yet. Please verify your email.');
    }
}
