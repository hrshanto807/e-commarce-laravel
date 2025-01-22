<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolicyController;
use App\Http\Middleware\TokenAuthenticate;
use App\Http\Controllers\InvoiceController;

// page route
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/by-category',[ProductController::class,'ByCategory']);
Route::get('/by-brand',[ProductController::class,'ByBrand']);
Route::get('/policy',[PolicyController::class,'PolicyPage']);
Route::get('/details',[ProductController::class,'ProductDetailsPage']);
Route::get('/login',[UserController::class,'LoginPage']);
Route::get('/verify', [UserController::class,'VerifyPage']);
Route::get('/cart', [ProductController::class,'ProductCartPage']);
Route::get('/wish', [ProductController::class,'ProductWishPage']);



// web api
Route::get("/BrandList",[BranController::class,'BrandList']);
Route::get("/CategoryList",[CategoryController::class,'CategoryList']);
Route::get('/ListProductByCategory/{id}',[ProductController::class,'ProductListByCategory']);
Route::get('/ListProductByBrand/{id}',[ProductController::class,'ProductListByBrand']);
Route::get('/ListProductByRemark/{remark}',[ProductController::class,'ProductListByRemark']);
Route::get('/ListProductBySlider',[ProductController::class,'ProductListBySlider']);
Route::get('/ProductDetailsById/{id}',[ProductController::class,'ProductDetailsById']);
Route::get('/ListProductByReview/{id}',[ProductController::class,'ProductListByReview']);


Route::get('/userLogin/{UserEmail}',[UserController::class,'UserLogin']);
Route::get('/VerifyLogin/{UserEmail}/{OTP}',[UserController::class,'VerifyLogin']);
Route::get('/logout',[UserController::class,'UserLogout']);


// user profile

Route::post('/CreateProfile',[ProfileController::class,'CreateProfile'])->middleware([TokenAuthenticate::class]);

Route::get('/ReadProfile',[ProfileController::class,'ReadProfile'])->middleware([TokenAuthenticate::class]);


// product review

Route::post('/CreateProductReview',[ProductController::class,'CreateProductReview'])->middleware([TokenAuthenticate::class]);

// wish list
Route::get('/CreateWishList/{product_id}',[ProductController::class,'CreateWishList'])->middleware([TokenAuthenticate::class]);
Route::get('/ProductWishList',[ProductController::class,'ProductWishList'])->middleware([TokenAuthenticate::class]);   
Route::get('/RemoveWishList/{product_id}',[ProductController::class,'RemoveWishList'])->middleware([TokenAuthenticate::class]);

// cart list

Route::post('/CreateCartList', [ProductController::class, 'CreateCartList'])->middleware([TokenAuthenticate::class]);
Route::get('/ProductCartList',[ProductController::class,'ProductCartList'])->middleware([TokenAuthenticate::class]);    
Route::get('/RemoveCartList/{product_id}',[ProductController::class,'RemoveCartList'])->middleware([TokenAuthenticate::class]);

// invoice 

Route::get('/CreateInvoice',[InvoiceController::class,'CreateInvoice'])->middleware([TokenAuthenticate::class]);
Route::get('/ReadInvoice',[InvoiceController::class,'ReadInvoice'])->middleware([TokenAuthenticate::class]);
Route::get('/InvoiceProductDetails/{invoice_id}',[InvoiceController::class,'InvoiceProductDetails'])->middleware([TokenAuthenticate::class]);

// payment

Route::post('/PaymentSuccess',[InvoiceController::class,'PaymentSuccess']);
Route::post('/PaymentFail',[InvoiceController::class,'PaymentFail']);
Route::post('/PaymentCancel',[InvoiceController::class,'PaymentCancel']);


// policy route
Route::get('/PolicyByType/{type}',[PolicyController::class,'PolicyByType']);
