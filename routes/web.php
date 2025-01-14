<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolicyController;
use App\Http\Middleware\TokenAuthenticate;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [UserController::class,'UserLogin']);

Route::get("/BrandList",[BranController::class,'BrandList']);
Route::get("/CategoryList",[CategoryController::class,'CategoryList']);


Route::get('/ListProductByCategory/{id}',[ProductController::class,'ProductListByCategory']);
Route::get('/ListProductByBrand/{id}',[ProductController::class,'ProductListByBrand']);
Route::get('/ListProductByRemark/{remark}',[ProductController::class,'ProductListByRemark']);
Route::get('/ListProductBySlider',[ProductController::class,'ProductListBySlider']);
Route::get('/ProductDetailsById/{id}',[ProductController::class,'ProductDetailsById']);
Route::get('/ListProductByReview/{id}',[ProductController::class,'ProductListByReview']);


Route::get('/userLogin/{UserEmail}',[UserController::class,'UserLogin']);
Route::get('/userLoginOtp/{UserEmail}/{OTP}',[UserController::class,'VerifyLogin']);
Route::get('/logout',[UserController::class,'UserLogout']);


// user profile

Route::post('/CreateProfile',[ProfileController::class,'CreateProfile'])->middleware([TokenAuthenticate::class]);

Route::get('/ReadProfile',[ProfileController::class,'ReadProfile'])->middleware([TokenAuthenticate::class]);
