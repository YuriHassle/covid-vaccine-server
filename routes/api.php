<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinatorController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServicegroupController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('vaccinators', VaccinatorController::class, ['only' => ['index']]);
    Route::resource('citizens', CitizenController::class, ['only' => ['index']]);
    Route::resource('locations', LocationController::class, ['only' => ['index']]);
    Route::resource('lots', LotController::class, ['only' => ['index']]);
    Route::resource('categories', CategoryController::class, ['only' => ['index']]);
    Route::resource('servicegroups', ServicegroupController::class, ['only' => ['index']]);
    Route::resource('applications', ApplicationController::class, ['only' => ['store', 'index']]);
});
