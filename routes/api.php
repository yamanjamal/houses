<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HousestestController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesAndDislikesController;
use App\Http\Controllers\ImgeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatGroupsController;

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



// +++++++++++++++++++++++++++++++start chatroom api+++++++++++++++++++++++++++++++++++
// Route::group(['middleware' => 'auth:sanctum'], function() {
    // Route::get('/search/{title}',    [ChatController::class,'search']); 
Route::group(['prefix' => 'chat','middleware' => 'auth:sanctum'], function() {
    Route::get('/index',             [ChatGroupsController::class,'index']);
    Route::get('/show/{chatGroups}',      [ChatGroupsController::class,'show'])
    ->missing(function(){return response()->json('there is no such id !',404);});
    Route::post('/store',            [ChatGroupsController::class,'store']);
    Route::put('/update/{chatGroups}',    [ChatGroupsController::class,'update'])
    ->missing(function(){return response()->json('there is no such id !',404);}); 
    Route::delete('/destroy/{chatGroups}',[ChatGroupsController::class,'destroy'])
    ->missing(function(){return response()->json('there is no such id !',404);});
});
// });
// +++++++++++++++++++++++++++++++end chatromm api+++++++++++++++++++++++++++++++++++


// +++++++++++++++++++++++++++++++start message api+++++++++++++++++++++++++++++++++++
// Route::group(['middleware' => 'auth:sanctum'], function() {
    // Route::get('/search/{title}',    [ChatController::class,'search']); 
Route::group(['prefix' => 'message','middleware' => 'auth:sanctum'], function() {
    Route::post('/store',            [ChatController::class,'store']);
    Route::put('/update/{chat}',    [ChatController::class,'update'])
    ->missing(function(){return response()->json('there is no such id !',404);}); 
    Route::delete('/destroy/{chat}',[ChatController::class,'destroy'])
    ->missing(function(){return response()->json('there is no such id !',404);});
});
// });
// +++++++++++++++++++++++++++++++end message api+++++++++++++++++++++++++++++++++++






// ++++++++++++++++++++++++++++start user info api+++++++++++++++++++++++++++++++++++
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ++++++++++++++++++++++++++++end user info api+++++++++++++++++++++++++++++++++++

// ++++++++++++++++++++++++++++start public api+++++++++++++++++++++++++++++++++++

Route::post('/register',  [RegisterController::class,'register']);
Route::post('/login',      [RegisterController::class,'login']);

Route::get('public/index',             [HousestestController::class,'index']);
Route::get('public/show/{house}',      [HousestestController::class,'show'])
->missing(function(){return response()->json('there is no such id !',404);});
Route::get('public/search/{title}',    [HousestestController::class,'search']); 
// +++++++++++++++++++++++++++++end public api+++++++++++++++++++++++++++++++++++

// +++++++++++++++++++++++++++++start houses api+++++++++++++++++++++++++++++++++++
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/search/{title}',    [HousestestController::class,'search']); 
    Route::get('/index',             [HousestestController::class,'index']);
    Route::get('/show/{house}',      [HousestestController::class,'show'])
    ->missing(function(){return response()->json('there is no such id !',404);});
    Route::post('/store',            [HousestestController::class,'store']);
    Route::put('/update/{house}',    [HousestestController::class,'update'])
    ->missing(function(){return response()->json('there is no such id !',404);}); 
    Route::delete('/destroy/{house}',[HousestestController::class,'destroy'])
    ->missing(function(){return response()->json('there is no such id !',404);});
    Route::get('/logout',            [RegisterController::class,'logout']);
});
// +++++++++++++++++++++++++++end houses api+++++++++++++++++++++++++++++++++++

// +++++++++++++++++++++++++++start comments api+++++++++++++++++++++++++++++++++++
Route::prefix('comment')->name('comment.')->middleware('auth:sanctum')->group(function(){
    Route::post('/store',              [CommentController::class,'store']);
    Route::put('/update/{comment}',    [CommentController::class,'update'])
    ->missing(function(){return response()->json('there is no such id !',404);});; 
    Route::delete('/destroy/{comment}',[CommentController::class,'destroy'])
    ->missing(function(){return response()->json('there is no such id !',404);});; 
});
// +++++++++++++++++++++++++++++end comments api+++++++++++++++++++++++++++++++++++


// +++++++++++++++++++++++++++++start likes api+++++++++++++++++++++++++++++++++++
Route::prefix('like')->name('like.')->middleware('auth:sanctum')->group(function(){
    Route::post('/store',         [LikesAndDislikesController::class,'store'])
    ->missing(function(){return response()->json('there is no such id !',404);});
    Route::put('/update/{id}',    [LikesAndDislikesController::class,'update']); 
    Route::delete('/destroy/{id}',[LikesAndDislikesController::class,'destroy']); 
});
// +++++++++++++++++++++++++++++++end likes api+++++++++++++++++++++++++++++++++++

// +++++++++++++++++++++++++++++++start images api+++++++++++++++++++++++++++++++++++
Route::prefix('image')->name('image.')->middleware('auth:sanctum')->group(function(){
    Route::post  ('/store/{house}',[ImgeController::class,'store'])
    ->missing(function(){return response()->json('there is no such id !',404);});
    Route::delete('/destroy/{img}',[ImgeController::class,'destroy'])
    ->missing(function(){return response()->json('there is no such id !',404);});   
});
// +++++++++++++++++++++++++++++++end images api+++++++++++++++++++++++++++++++++++


