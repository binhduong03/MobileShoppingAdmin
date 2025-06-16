<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenuController;

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