<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\StudentsController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommitteeController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\api\v1','middleware'=>['auth:sanctum']],function(){
//     Route::apiResource('sports',StudentsController::class);
// });

// Route::post('/register',[UserController::class, 'register']);
// Route::post('/login',[UserController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout',[UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::post('/add-committee', [UserController::class, 'addCommittee']);
        Route::post('/add-game', [GameController::class, 'addGame']);
    });


    Route::middleware('role:committee')->group(function () {
        Route::post('/add-co-committee', [UserController::class, 'addCoCommittee']);
    });


    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [UserController::class, 'logout']);
});

