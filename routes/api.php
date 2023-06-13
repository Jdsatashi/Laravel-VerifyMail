<?php

use App\Http\Controllers\Api\AssignController;
use App\Http\Controllers\Api\ClasseController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
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

Route::Post('register', [AuthController::class, 'register']);
Route::Post('login', [AuthController::class, 'login']);
Route::post('password/reset', [AuthController::class, 'ResetPassword']);

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::post('verify-email/', [EmailVerificationController::class, 'sendVerificationEmail']);
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('user/profile/{id}', [UserController::class, 'ShowProfile']);
    Route::put('user/profile/{id}', [UserController::class, 'UpdateProfileUser']);

    Route::controller(CourseController::class)->group(function() {
        Route::get('course', 'index');
        Route::post('course/create', 'store')->middleware('admin.role');
    });

    Route::controller(ClasseController::class)->group(function() {
        Route::get('class', 'index');
        Route::post('class/create', 'store')->middleware('admin.role');
        Route::get('class/{id}', 'show');
    });

    Route::post('class/{classe}/assign', [AssignController::class,'assignClass']);
    Route::get('classed/assigned', [AssignController::class, 'assign_list']);
});
