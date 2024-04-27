<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ClinicHistoryController;

Route::group(['prefix' => 'roles'], function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{id}', [RoleController::class, 'show']);
    Route::put('/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);
});

Route::group(['prefix' => 'collaborators'], function () {
    Route::get('/', [CollaboratorController::class, 'index']);
    Route::post('/', [CollaboratorController::class, 'store']);
    Route::get('/{id}', [CollaboratorController::class, 'show']);
    Route::put('/{id}', [CollaboratorController::class, 'update']);
    Route::delete('/{id}', [CollaboratorController::class, 'destroy']);
});

Route::group(['prefix' => 'accesses'], function () {
    Route::get('/', [AccessController::class, 'index']);
    Route::post('/access-and-collaborator', [AccessController::class, 'createAccessAndCollaborator']);
    Route::post('/', [AccessController::class, 'store']);
    Route::get('/{username}/collaborator', [AccessController::class, 'getCollaboratorByAccess']);
    Route::get('/{id}', [AccessController::class, 'show']);
    Route::put('/{id}', [AccessController::class, 'update']);
    Route::delete('/{id}', [AccessController::class, 'destroy']);
});

Route::group(['prefix' => 'trackings'], function () {
    Route::get('/', [TrackingController::class, 'index']);
    Route::post('/', [TrackingController::class, 'store']);
    Route::get('/{id}', [TrackingController::class, 'show']);
    Route::put('/{id}', [TrackingController::class, 'update']);
    Route::delete('/{id}', [TrackingController::class, 'destroy']);
});

Route::group(['prefix' => 'clinic-histories'], function () {
    Route::get('/', [ClinicHistoryController::class, 'index']);
    Route::post('/', [ClinicHistoryController::class, 'store']);
    Route::get('/{id}', [ClinicHistoryController::class, 'show']);
    Route::put('/{id}', [ClinicHistoryController::class, 'update']);
    Route::delete('/{id}', [ClinicHistoryController::class, 'destroy']);
});
