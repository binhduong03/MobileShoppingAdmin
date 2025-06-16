<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

Route::get('/reset-password-form', [ForgotPasswordController::class, 'showResetForm']);
Route::post('/submit-new-password', [ForgotPasswordController::class, 'submitNewPassword']);



Route::get('/', function () {
    return view('welcome');
});

//BACKEND
Route::get('/admin', [AdminController::class, 'admin']);

//Liên hệ
Route::get('/admin/all-contact', [ContactController::class,'all_contact']);

//Sản phẩm 
Route::get('/admin/all-product', [ProductController::class,'all_product']);
