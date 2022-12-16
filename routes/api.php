<?php

use App\Http\Controllers\Api\V1\MaterialController;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'materials' => MaterialController::class,
]);
