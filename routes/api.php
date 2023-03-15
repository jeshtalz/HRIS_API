<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HolidaysController;

use App\Http\Controllers\SalaryGradeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\QualificationStandardController;
use App\Http\Controllers\PersonalDataSheetController;
use App\Http\Controllers\PositionDescriptionController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/holidays', HolidaysController::class);


    Route::resource('/salary-grade', SalaryGradeController::class);
    Route::resource('/position', PositionController::class);
    Route::resource('/office', OfficeController::class);
    Route::resource('/position-description', PositionDescriptionController::class);
    Route::resource('/qualification-standard', QualificationStandardController::class);
    Route::resource('/personal-data-sheet', PersonalDataSheetController::class);



    
});
