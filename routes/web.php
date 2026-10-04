<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;

Route::get('/','App\Http\Controllers\login@index');
Route::post('login','App\Http\Controllers\login@aksilogin');


Route::get('/home','App\Http\Controllers\login@home');
Route::get('/logout','App\Http\Controllers\login@logout');

Route::get('/inputdata','App\Http\Controllers\login@register');
Route::post('/input','App\Http\Controllers\login@signup');



