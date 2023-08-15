<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login'); // Define named route for login

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/{id}', [UserController::class, 'show'])->name('show'); // Define named route for user
    Route::put('users/{id}', [UserController::class, 'update'])->name('update'); // Define named route for update
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('inside-mware', function () {
       return response()->json('Success', 200);
    });
});
