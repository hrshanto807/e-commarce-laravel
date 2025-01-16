<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolicyController;
use App\Http\Middleware\TokenAuthenticate;
use App\Http\Controllers\InvoiceController;


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


// product review

Route::post('/CreateProductReview',[ProductController::class,'CreateProductReview'])->middleware([TokenAuthenticate::class]);

// wish list
Route::get('/CreateWishList',[ProductController::class,'CreateWishList'])->middleware([TokenAuthenticate::class]);
Route::get('/ProductWishList/{product_id}',[ProductController::class,'ProductWishList'])->middleware([TokenAuthenticate::class]);   
Route::get('/RemoveWishList/{product_id}',[ProductController::class,'RemoveWishList'])->middleware([TokenAuthenticate::class]);

// cart list

Route::post('/CreateCartList',[ProductController::class,'CreateCartList'])->middleware([TokenAuthenticate::class]);
Route::get('/ProductCartList',[ProductController::class,'ProductCartList'])->middleware([TokenAuthenticate::class]);    
Route::get('/RemoveCartList/{product_id}',[ProductController::class,'RemoveCartList'])->middleware([TokenAuthenticate::class]);

// invoice 

Route::get('/CreateInvoice',[InvoiceController::class,'CreateInvoice'])->middleware([TokenAuthenticate::class]);
Route::get('/ReadInvoice',[InvoiceController::class,'ReadInvoice'])->middleware([TokenAuthenticate::class]);
Route::get('/InvoiceProductDetails/{invoice_id}',[InvoiceController::class,'InvoiceProductDetails'])->middleware([TokenAuthenticate::class]);
