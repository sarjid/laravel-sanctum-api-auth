<?php

use App\Http\Controllers\Api\Admin\AdminAuthController;
use App\Http\Controllers\Api\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




// Route::controller(AuthController::class)->group(function () {
//     Route::post('/login', 'login');
//     Route::post('/register', 'register');
// });





// Route::middleware('auth:user-api')->group(function () {
//     Route::controller(AuthController::class)->group(function () {
//         Route::get('/user', 'user');
//         Route::post('/logout', 'logout');
//     });
// });


// Route::middleware('auth:admin-api')->group(function () {
//     Route::controller(AdminAuthController::class)->group(function () {
//         Route::get('/admin', 'user');
//         Route::post('/admin/logout', 'logout');
//     });
// });

