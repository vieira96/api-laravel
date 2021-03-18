<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
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
Route::post('/create', [UserController::class, 'create']);
Route::get('/user/{id}', [UserController::class, 'read']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);

//adicioneei o {id?} para ser um parametro opcional. 
Route::get('/adresses/{id?}', [AddressController::class, 'adresses']);
Route::get('/states/{id?}', [AddressController::class, 'states']);
Route::get('/cities/{id?}', [AddressController::class, 'cities']);

Route::get('/user-per-city', [CityController::class, 'countUsersPerCity']);
Route::get('/user-per-state', [StateController::class, 'countUsersPerState']);
