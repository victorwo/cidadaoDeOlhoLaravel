<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MachinesController;
use App\Http\Controllers\DeputadosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/listar-deputados', [DeputadosController::class, 'listar']);
Route::get('cadastrar-deputados', [DeputadosController::class, 'cadastrar']);
Route::get('', [DeputadosController::class, 'pesquisar']);
#Route::put('/{mes}', [UserController::class, 'calcularVerbas']);


Route::post('', [DeputadosController::class, 'calcularVerbas']);




