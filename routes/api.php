<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\LandlordController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UnitListController;
use Illuminate\Http\Request;

// Handle preflight OPTIONS requests for all API routes
Route::options('{any}', function (Request $request) {
    return response('', 200);
})->where('any', '.*');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('buildings', BuildingController::class);
    Route::apiResource('tenants', TenantController::class);
    Route::apiResource('landlords', LandlordController::class);
    Route::apiResource('buildings.units', UnitController::class);
    Route::get('/units', [UnitListController::class, 'index']);
});

