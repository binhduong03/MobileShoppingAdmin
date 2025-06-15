<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

Route::get('/reset-password-form', [ForgotPasswordController::class, 'showResetForm']);
Route::post('/submit-new-password', [ForgotPasswordController::class, 'submitNewPassword']);



Route::get('/', function () {
    return view('welcome');
});

//BACKEND
Route::get('/admin', [AdminController::class, 'admin']);


Route::get('/all-contact', [ContactController::class,'all_contact']);



