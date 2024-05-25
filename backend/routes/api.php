<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::post('/add-committee', [UserController::class, 'addCommittee']);
        Route::post('/assign-committee/{game}', [GameController::class, 'assignCommittee']);
        Route::apiResource('games', GameController::class);
    });

    Route::middleware('role:committee')->group(function () {
        Route::post('/add-co-committee', [UserController::class, 'addCoCommittee']);
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [UserController::class, 'logout']);
});


