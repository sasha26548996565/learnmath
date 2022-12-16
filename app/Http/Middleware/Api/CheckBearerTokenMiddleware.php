<?php

namespace App\Http\Middleware\Api;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class CheckBearerTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $user = User::where('token', $token)->first();

        if (is_null($user))
            return response()->json(['status' => false, 'message' => 'User not found']);

        return $next($request);
    }
}
