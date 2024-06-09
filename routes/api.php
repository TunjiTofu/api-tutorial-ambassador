<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return 'Hilda';
});

//Admin
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum', 'scope.admin'])->group(function () {
        Route::get('user', [AuthController::class, 'authUser'])->name('user');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::put('users/info', [AuthController::class, 'updateInfo'])->name('update.info');
        Route::put('users/password', [AuthController::class, 'updatePassword'])->name('update.password');

        
        Route::get('ambassadors', [AmbassadorController::class, 'index'])->name('ambassadors');
    });
});



//Ambassador

//Checkout
