<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::get('/reset-password-form', [ForgotPasswordController::class, 'showResetForm']);
Route::post('/submit-new-password', [ForgotPasswordController::class, 'submitNewPassword']);



Route::get('/', function () {
    return view('welcome');
});

//BACKEND
Route::get('/admin', [AdminController::class, 'admin']);

//Contact
Route::get('Admin/all-contact', [ContactController::class,'all_contact']);
Route::get('Admin/detail-contact/{contact_id}', [ContactController::class, 'detail_contact']);
Route::post('/update-isread/{contact_id}', [ContactController::class, 'update_isread']);

//Menu
Route::get('Admin/all-menu', [MenuController::class, 'all_menu']);
Route::get('Admin/add-menu', [MenuController::class, 'add_menu']);
Route::post('Admin/save-menu', [MenuController::class, 'save_menu']);
Route::get('Admin/edit-menu/{id}', [MenuController::class, 'edit_menu']);
Route::post('Admin/update-menu/{id}', [MenuController::class, 'update_menu']);
Route::get('delete-menu/{id}', [MenuController::class, 'delete_menu']);

//Product
Route::get('Admin/all-product', [ProductController::class, 'all_product']);
Route::get('Admin/add-product', [ProductController::class, 'add_product']);
Route::post('Admin/save-product', [ProductController::class, 'save_product']);
Route::get('Admin/edit-product/{id}', [ProductController::class, 'edit_product']);
Route::post('Admin/update-product/{id}', [ProductController::class, 'update_product']);
Route::get('delete-product/{id}', [ProductController::class, 'delete_product']);

//Order
Route::get('Admin/all-order', [OrderController::class, 'all_order']);
Route::get('Admin/detail-order/{id}', [OrderController::class, 'detail_order']);
Route::get('/delete-order/{id}', [OrderController::class, 'delete_order']);
Route::post('/update-status', [OrderController::class, 'update_status']);

//User
Route::get('Admin/all-user', [UserController::class, 'all_user']);
Route::get('Admin/add-user', [UserController::class, 'add_user']);
Route::post('Admin/save-user', [UserController::class, 'save_user']);
Route::get('Admin/edit-user/{id}', [UserController::class, 'edit_user']);
Route::post('Admin/update-user/{id}', [UserController::class, 'update_user']);
Route::get('delete-user/{id}', [UserController::class, 'delete_user']);