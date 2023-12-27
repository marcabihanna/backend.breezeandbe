<?php

use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NewsLetterController;
use App\Http\Controllers\Api\Page1Controller;
use App\Http\Controllers\Api\Page2Controller;
use App\Http\Controllers\Api\Page3Controller;
use App\Http\Controllers\Api\Page4Controller;
use App\Http\Controllers\Api\Page5Controller;
use App\Http\Controllers\Api\Page6Controller;
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

Route::get('/home',[HomeController::class,'index']);
Route::get('/company_details' ,[Page1Controller::class,'index']);
Route::get('/all_products' ,[Page2Controller::class,'index']);
Route::post('/product',[Page3Controller::class,'show']);
Route::get('/checkout',[Page4Controller::class,'index']);
Route::post('/checkout',[Page4Controller::class,'addOrder']);
Route::get('/privacy_policy',[Page5Controller::class,'index']);
Route::get('/overview' ,[Page6Controller::class,'index']);
Route::post('/check_coupon',[CouponController::class,'code']);
Route::post('/NewsLetter',[NewsLetterController::class,'store']);
