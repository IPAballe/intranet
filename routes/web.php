<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnergiaController;
use App\Http\Controllers\MetroController;
use App\Http\Livewire\LiveLecturas;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;


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
    return view('welcome');
});

Route::get('/rhumanos/listado', [App\Http\Controllers\EmployeeController::class, 'listadoGeneral']);
Route::get('/rhumanos/prueba', function () {   return view('prueba'); });
Route::get('/rhumanos/ficha', function () {   return view('ficha'); });
Route::get('/rhumanos/cumpleanos', function () {   return view('cumpleanos'); });

Route::group(['middleware' =>'auth:sanctum'], function()
{
    Route::get('/energia/entidades',       [EnergiaController::class, 'entidades'])->name(name:'energia.entidades');
    Route::get('/energia/lecturas',        [EnergiaController::class, 'lecturas'])->name(name:'energia.lecturas');
    Route::get('/energia/planes',          [EnergiaController::class, 'planes'])->name(name:'energia.planes');
    Route::get('/energia/metrocontadores', [MetroController::class,   'listado'])->name(name:'energia.metrocontadores');
});

Route::get('/energia/consumos_dia', [EnergiaController::class, 'consumos_dia'])->name(name:'energia.consumos_dia');
Route::get('/energia/consumos_mes', [EnergiaController::class, 'consumos_mes'])->name(name:'energia.consumos_mes');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



