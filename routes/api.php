<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/appointment/')->group(function () {
	Route::get('list', [AppointmentController::class, 'index']);
	Route::get('create', [AppointmentController::class, 'create']);
	Route::post('store', [AppointmentController::class, 'store']);
	Route::get('reschedule', [AppointmentController::class, 'reschedule']);
	Route::put('reschedule', [AppointmentController::class, 'update']);
	Route::get('arrived', [AppointmentController::class, 'arrived']);

	Route::get('patients', [PatientController::class, 'get_patients']);
});