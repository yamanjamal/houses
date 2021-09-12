<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HousesController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesAndDislikesController;
use App\Http\Controllers\ImgeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ++++++++++++++++++++++++++++++++++++start public api+++++++++++++++++++++++++++++++++++
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/register',      [RegisterController::class,'register']);
Route::get('/login',         [RegisterController::class,'login']);

Route::get('/index',         [HousesController::class,'index']);
Route::get('/search/{title}',[HousesController::class,'search']); 
Route::get('/show/{id}',     [HousesController::class,'show']);

// ++++++++++++++++++++++++++++++++++++end public api+++++++++++++++++++++++++++++++++++



// ++++++++++++++++++++++++++++++++++++start houses api+++++++++++++++++++++++++++++++++++
// Route::resource('user', 'UserController');
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/store',         [HousesController::class,'store']);
    Route::put('/update/{id}',    [HousesController::class,'update']); 
    Route::delete('/destroy/{id}',[HousesController::class,'destroy']); 
    Route::get('/logout',         [RegisterController::class,'logout']);
});
// ++++++++++++++++++++++++++++++++++++end houses api+++++++++++++++++++++++++++++++++++




// ++++++++++++++++++++++++++++++++++++start comments api+++++++++++++++++++++++++++++++++++

Route::prefix('comment')->name('comment.')->middleware('auth:sanctum')->group(function(){
    // Route::get('/index',          [CommentController::class,'index']);
    // Route::get('/show/{id}',      [CommentController::class,'show']);
    Route::post('/store',         [CommentController::class,'store']);
    Route::put('/update/{id}',    [CommentController::class,'update']); 
    Route::delete('/destroy/{id}',[CommentController::class,'destroy']); 
});
// ++++++++++++++++++++++++++++++++++++end comments api+++++++++++++++++++++++++++++++++++

// ++++++++++++++++++++++++++++++++++++start likes api+++++++++++++++++++++++++++++++++++

Route::prefix('like')->name('like.')->middleware('auth:sanctum')->group(function(){
    Route::post('/store',         [LikesAndDislikesController::class,'store']);
    Route::put('/update/{id}',    [LikesAndDislikesController::class,'update']); 
    Route::delete('/destroy/{id}',[LikesAndDislikesController::class,'destroy']); 
});
// ++++++++++++++++++++++++++++++++++++end likes api+++++++++++++++++++++++++++++++++++

Route::prefix('image')->name('image.')->middleware('auth:sanctum')->group(function(){
    // Route::get   ('/index',       [ImgeController::class,'index']);
    // Route::get   ('/show/{id}',   [ImgeController::class,'show']);
    Route::post  ('/store',       [ImgeController::class,'store']);
    // Route::put   ('/update/{id}', [ImgeController::class,'update']); 
    Route::delete('/destroy/{id}',[ImgeController::class,'destroy']); 
});

