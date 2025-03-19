<?php

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\EventApprovalController;


 
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});





Route::group([
    'middleware' => 'auth:api',
], function ($router) {
    // Club Routes (Only Admins and Club Managers)
    Route::apiResource('clubs', ClubController::class)->middleware('club_manager');

    // Event Routes (Only Club Managers)
    Route::apiResource('events', EventController::class)->middleware('club_manager');

    // University Routes (Admins only)
    Route::apiResource('universities', UniversityController::class)->middleware('admin');

    // Administration Routes (Admins only)
    Route::apiResource('administrations', AdministrationController::class)->middleware('admin');

    // Event Approvals (Admins only)
    Route::apiResource('event-approvals', EventApprovalController::class)->middleware('admin');
});