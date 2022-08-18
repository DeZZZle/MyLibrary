<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTokenMiddleware
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
        if ($request->bearerToken() !== null)
            $token = $request->bearerToken();
        elseif ($request->header( 'api_token') !== null)
            $token = $request->header( 'api_token');
        elseif ($request->api_token !== null)
            $token = $request->api_token;

        if ($token !== null)
        {
            $user = User::query()->where('api_token', $token)->first();
            if ($user !== null)
            {
                Auth::login($user);
                return $next($request);
            }
        }
        return response()->json(['message'=> 'Ваш токен недествителен'], 401);

    }
}
