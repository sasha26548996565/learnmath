<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegisterRequest;

class UserController extends Controller
{
    private const LENGTH_TOKEN = 150;

    public function register(RegisterRequest $request): JsonResponse
    {
        $params = $request->validated();
        $params['password'] = Hash::make($params['password']);
        User::create($params);

        return response()->json(['status' => true]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $params = $request->validated();
        $user = User::where('email', $params['email'])->first();

        if (is_null($user))
            return response()->json(['status' => false, 'message' => 'User not found'], Response::HTTP_UNAUTHORIZED);

        if (! Hash::check($params['password'], $user->password))
            return response()->json(['status' => false, 'message' => 'Password not correct']);

        $token = Str::random(self::LENGTH_TOKEN);
        $user->token = $token;
        $user->save();

        return response()->json(['status' => true, 'token' => $token]);
    }
}
