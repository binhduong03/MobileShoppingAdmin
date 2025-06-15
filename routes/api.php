<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ForgotPasswordController;

//Gửi mail
Route::post('/send-reset-mail', [ForgotPasswordController::class, 'sendResetMail']);

// Đăng nhập, Đăng ký
Route::post('/login-user', [UserController::class, 'login']);
Route::post('/update-user', [UserController::class, 'update']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/update-token', [UserController::class, 'updateToken']);


// Liên hệ

Route::post('/contact', [ContactController::class, 'contact']);

Route::get('/menu', [MenuController::class, 'menu']);

//Sản phẩm
Route::get('/all-product', [ProductController::class, 'product']);
Route::post('/products-by-type', [ProductController::class, 'getByType']);

//Tìm kiếm
Route::post('/search', [ProductController::class, 'search']);

//đơn hàng
Route::post('/place-order', [OrderController::class, 'placeOrder']);

//lịch sử đơn hàng
Route::post('/history', [OrderController::class, 'getOrdersByUser']);


