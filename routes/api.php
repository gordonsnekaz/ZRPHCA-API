<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [PatientController::class, 'store']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('cities', CityController::class);
    Route::apiResource('pharmacies', PharmacyController::class);
    Route::apiResource('hospitals', HospitalController::class);
    Route::apiResource('news', NewsController::class);
    Route::apiResource('reports', ReportController::class);
    Route::apiResource('appointment', AppointmentController::class);
    Route::post('chatbot', [ChatbotController::class, 'chat']);
});