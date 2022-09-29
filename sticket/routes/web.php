<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TicketController;
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

Route::get('/', function () {
    return view('welcome');
});

############################
// Ruta de prueba

Route::get('/prueba', function(){

    $clientes = \App\Models\Cliente::all();
    dd($clientes);
});


########################
##### CRUD DE CLIENTES ###

Route::get('/clientes',  [ClienteController::class, 'index']);

//Route::view('/adminClientes', ['adminClientes']);

########################
##### CRUD DE CATEGORIAS ###
Route::get('/adminCategorias', [CategoriaController::class, 'index']);
Route::get('/agregarCategoria', [CategoriaController::class, 'create']);
Route::post('/agregarCategoria',[CategoriaController::class,'store']);
Route::get('/modificarCategoria/{idCategoria}',[CategoriaController::class,'edit']);
Route::patch('/modificarCategoria',[CategoriaController::class,'update']);


########################
##### CRUD DE TICKETS ###

Route::get('/adminTickets', [TicketController::class,'index']);
Route::get('/agregarTicket', [TicketController::class,'create']);
Route::post('/agregarTicket', [TicketController::class,'store']);

Route::get('/eliminarTicket/{idTicket}', [TicketController::class, 'confirmarBaja']);
Route::delete('/eliminarTicket', [TicketController::class,'destroy']);

