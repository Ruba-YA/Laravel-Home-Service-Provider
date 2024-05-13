<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RecruitmentCountriesController;

//Public Routes

Route::post('/register' , [AuthController::class,'register'])->name('auth.register');
Route::post('/login' , [AuthController::class,'login'])->name('auth.login');


//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {
     //user
    Route::post('/logout',   [AuthController::class, 'logout']);
    Route::get('/user' , [AuthController::class , 'user']);
    //worker

    Route::get('/workers' , [WorkerController::class , 'index']); // show all workers
    Route::post('/workers' , [WorkerController::class , 'store']); //create worker
    Route::get('/workers/{id}' , [WorkerController::class , 'show']); // show singel worker
    Route::put('/workers/{id}' , [WorkerController::class , 'update']); // update worker 
    Route::delete('/workers/{id}' , [WorkerController::class , 'destroy']); // delete worker


    // Appointment 

    Route::post('/appointments' , [AppointmentController::class , 'store']); //create appointments
    Route::get('/appointments' , [AppointmentController::class , 'show']); // show all appointments
    Route::delete('/appointments/{id}' , [AppointmentController::class , 'cancel']); // Cancel an  appointments


    // countries

    Route::get('/countries' , [RecruitmentCountriesController::class , 'index']); // show all countries
    Route::post('/countries' , [RecruitmentCountriesController::class , 'store']); //create countries
    Route::put('/countries/{id}' , [RecruitmentCountriesController::class , 'update']); // update countries 
    Route::delete('/countries/{id}' , [RecruitmentCountriesController::class , 'destroy']); // delete countries
    Route::get('/countries/{id}' , [RecruitmentCountriesController::class , 'show']); // show singel countries





    
  });





