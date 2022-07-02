<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Soal1Controller;
use App\Http\Controllers\Soal2Controller;
use App\Http\Controllers\Soal3Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/soal1');;
});
Route::get('/soal1',[Soal1Controller::class, 'index']);
Route::post('/soal1',[Soal1Controller::class, 'store']);
Route::get('/soal2',[Soal2Controller::class, 'index']);
Route::post('/soal2',[Soal2Controller::class, 'store']);
Route::get('/soal3',[Soal3Controller::class, 'index']);
Route::post('/soal3',[Soal3Controller::class, 'store']);
