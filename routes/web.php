<?php

use App\Http\Controllers\CrudController;
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

Route::get("/",[CrudController::class,"index"])->name("crud.index");

//Agregar un producto
Route::post("/agregar-producto",[CrudController::class,"create"])->name("crud.create");

//Actualizar un producto
Route::post("/actualizar-producto",[CrudController::class,"update"])->name("crud.update");

//Ruta para eliminar producto
Route::get("/eliminar-producto-{id}",[CrudController::class,"delete"])->name("crud.delete");