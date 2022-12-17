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
use Illuminate\Support\Facades\Auth;

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

        if (! Auth::attempt(['login' => $params['login'], 'password' => $params['password']]))
            return response()->json(['status' => false, 'message' => 'user not found']);

        $user = Auth::user();
        $token = $user->createToken('Test')->asseccToken;

        return response()->json(['status' => true, 'token' => $token]);
    }
}
