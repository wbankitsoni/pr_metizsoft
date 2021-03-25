<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
	Route::resource('users', UserController::class);
//Route::Resource('users',[App\Http\Controllers\UserController::class]);

//Route::get('/home', [HomeController::class, 'index'])
Route::get('get-state-list', [UserController::class,'getStateList']);
Route::get('get-city-list',[UserController::class,'getCityList']); 
});
