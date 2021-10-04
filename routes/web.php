<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ucontroller;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','preventbackhistory'])->group(function(){
        Route::view('/login','admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin','preventbackhistory'])->group(function(){
        Route::view('/home','admin.home')->name('home');
        Route::get('/index', [ucontroller::class, 'index'])->name('index');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

