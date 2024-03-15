<?php

use App\Http\Controllers\CrudController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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

Route::controller(CrudController::class)->group(function () {
    Route::get('/','index')->name('crud.index');
    Route::post('agregar-item','create')->name('crud.create');
    Route::post('actualizar-item-{id}','update')->name('crud.update');
    Route::get('eliminar-item-{id}','delete')->name('crud.delete');
});