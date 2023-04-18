<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/token', [AuthController::class, 'getAccessToken']);
Route::post('/auth/reset-password', [AuthController::class, 'passwordResetRequest']);
Route::post('/auth/change-password', [AuthController::class, 'changePassword']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/tags', [ListingController::class, 'tags']);
    Route::get('/categories', [ListingController::class, 'categories']);
    Route::get('/users', [ListingController::class, 'users'])->middleware('admin');

    Route::resource('/posts',  PostController::class, ['only' => ['index', 'show']]);
});
