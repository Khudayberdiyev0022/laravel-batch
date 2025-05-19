<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/upload', [App\Http\Controllers\SaleController::class,'index']);

Route::post('/upload',[App\Http\Controllers\SaleController::class,'upload']);
