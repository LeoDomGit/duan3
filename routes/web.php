<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/logout',[UserControllers::class,'logout']);
Route::get('/teams',[UserControllers::class,'logout']);
Route::get('/login',[LoginController::class,'loginIdx']);
Route::get('/', [UserControllers::class,'index']);
Route::get('auth/google', [GoogleController::class,'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[GoogleController::class,'callbackGoogle']);

Route::get('/allProjects',[ProjectController::class,'allProjects']);
