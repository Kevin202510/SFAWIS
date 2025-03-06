<?php

use App\Http\Controllers\Esp8266ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/esp8266',[Esp8266ApiController::class, 'index']);
