<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarDetailController;
use App\Http\Controllers\CarServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\StaffController;
use App\Models\CarDetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
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
Route::group(['middleware' => ['guest']], function() {

    Route::get('signin',function(){
        return view('signin');
    });
    Route::get('signup',function(){
        return view('signup');
    });
    Route::get('forgot_password',function(){
        return view('forgot_password');
    });
    });
Route::group(['middleware' => ['auth']], function () {

Route::get('/', function () {
    return view('dashboard');
});

Route::get('order_details',function(){
    return view('order_details.list');
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


Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::get('/offer', [CustomerController::class,'offer'])->name('offer');

Route::resource('cardetail',CarDetailController::class);
// Route::resource('carservices',CarServiceController::class);
Route::resource('packages',PackageController::class);
Route::resource('customers',CustomerController::class);
Route::resource('staff',StaffController::class);
Route::get('/assign_customer', [StaffController::class, 'assign_customer'])->name('staff.assign_customer');
Route::get('/reassign_customer/{id}', [StaffController::class, 'reassign_customer'])->name('staff.reassign_customer');
Route::post('/assignstaff', [StaffController::class, 'assignstaff'])->name('staff.assignstaff');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
