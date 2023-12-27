<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarDetailController;
use App\Http\Controllers\CarServiceController;
use App\Http\Controllers\PackageController;
use App\Models\CarDetail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('logout',function(){
    return view('logout');
});
Route::get('signin',function(){
    return view('signin');
});
Route::get('signup',function(){
    return view('signup');
});
Route::get('forgot_password',function(){
    return view('forgot_password');
});

Route::get('order_details',function(){
    return view('order_details.list');
});
Route::get('customer',function(){
    return view('customer.list');
});
Route::get('staff',function(){
    return view('staff.list');
});
Route::get('payment',function(){
    return view('payment.list');
});

// //car detail
// Route::get('/cardetail',[CarDetailController::class,'index'])->name('cardetail.index');
// Route::post('/cardetail/store',[CarDetailController::class,'store'])->name('cardetail.store');
// Route::post('/cardetail/{cardetail}', [CarDetailController::class, 'delete'])->name('cardetail.delete');
// Route::get('/cardetail/{cardetail}', [CarDetailController::class, 'show'])->name('cardetail.show');


Route::resource('cardetail',CarDetailController::class);
// Route::resource('carservices',CarServiceController::class);
Route::resource('packages',PackageController::class);