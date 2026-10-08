<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;

Route::get('/','App\Http\Controllers\login@index');
Route::post('login','App\Http\Controllers\login@aksilogin');


Route::get('/home','App\Http\Controllers\login@home');
Route::get('/print-pdf','App\Http\Controllers\login@printPdf');
Route::get('/logout','App\Http\Controllers\login@logout');

Route::get('/inputdata','App\Http\Controllers\login@register');
Route::post('/input','App\Http\Controllers\login@signup');

Route::get('/edit/{id}','App\Http\Controllers\login@edit');
Route::post('/edit/{id}','App\Http\Controllers\login@editdata');
Route::post('/delete/{id}', 'App\Http\Controllers\login@hapusdata');

Route::get('/export-excel', 'App\Http\Controllers\login@exportExcel');
Route::get('/export-pdf', 'App\Http\Controllers\login@printPdf');






