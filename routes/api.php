<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ResultController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login'); 

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/{id}', [UserController::class, 'show'])->name('show');
    Route::put('users/{id}', [UserController::class, 'update'])->name('update'); 
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('result', [ResultController::class, 'result'])->name ('result');
    Route::get('users/{user_id}/results', [ResultController::class, 'show'])->name('show');
    Route::get('users/results/topResults', [ResultController::class, 'topResults'])->name('topResults');
    Route::delete('users/{user_id}/results/{id}', [ResultController::class, 'destroy'])->name('destroy');
    Route::delete('users/{user_id}/deleteAll/results', [ResultController::class, 'destroyAll'])->name('destroyAll');



    Route::get('inside-mware', function () {
       return response()->json('Success', 200);
    });
});
