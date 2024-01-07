<?php

use App\Http\Controllers\api\CarController;
use App\Http\Controllers\api\PackageController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\StaffController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    // return $request->user();
// });
Route::post('register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/user',[AuthController::class, 'user']);
Route::post('/logout',[AuthController::class, 'logout']);
Route::post('/update_profile/{id}', [AuthController::class, 'update_profile']);
Route::get('/delete_profile/{id}', [AuthController::class, 'delete_profile']);

Route::resource('/car',CarController::class);
Route::resource('/package',PackageController::class);
Route::resource('/staff',StaffController::class);

    });
