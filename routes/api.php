<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\ConnectMoviesActorsController;

//Movie
Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store'])->middleware('auth:sanctum');
Route::post('/users/login', [UserController::class, 'login']);
Route::patch('/movies/{id}', [MovieController::class,'update'])->middleware('auth:sanctum');
Route::delete('/movies/{id}', [MovieController::class,'destroy'])->middleware('auth:sanctum');
Route::post('/movies/{movie}/actors', [MovieController::class, 'addActor'])->middleware('auth:sanctum');
Route::get('/movies/{movie}/studios', [MovieController::class, 'indexStudio']);
Route::put('/movies/{id}', [MovieController::class, 'update']);


//Actor
Route::get('/actors', [ActorController::class, 'index']);
Route::post('/actors', [ActorController::class, 'store'])->middleware('auth:sanctum');
Route::post('/users/login', [UserController::class, 'login']);
Route::patch('/actors/{id}', [ActorController::class,'update'])->middleware('auth:sanctum');
Route::delete('/actors/{id}', [ActorController::class,'destroy'])->middleware('auth:sanctum');
Route::put('/actors/{id}', [ActorController::class, 'update']);


//Category
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::post('/users/login', [UserController::class, 'login']);
Route::patch('/categories/{id}', [CategoryController::class,'update'])->middleware('auth:sanctum');
Route::delete('/categories/{id}', [CategoryController::class,'destroy'])->middleware('auth:sanctum');
Route::put('/categories/{id}', [CategoryController::class, 'update']);

//Director
Route::get('/directors', [DirectorController::class, 'index']);
Route::post('/directors', [DirectorController::class, 'store'])->middleware('auth:sanctum');
Route::post('/users/login', [UserController::class, 'login']);
Route::patch('/directors/{id}', [DirectorController::class,'update'])->middleware('auth:sanctum');
Route::delete('/directors/{id}', [DirectorController::class,'destroy'])->middleware('auth:sanctum');
Route::put('/directors/{id}', [DirectorController::class, 'update']);

//Studio
Route::get('/studios', [StudioController::class, 'index']);
Route::post('/studios', [StudioController::class, 'store'])->middleware('auth:sanctum');
Route::post('/users/login', [UserController::class, 'login']);
Route::patch('/studios/{id}', [StudioController::class,'update'])->middleware('auth:sanctum');
Route::delete('/studios/{id}', [StudioController::class,'destroy'])->middleware('auth:sanctum');
Route::get('/studios/{studio}/movies', [StudioController::class, 'index']);
Route::put('/studios/{id}', [StudioController::class, 'update']);

Route::get('/movies/{movie}/actors', [ConnectMoviesActorsController::class, 'index']);

Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
