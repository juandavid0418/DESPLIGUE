<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use App\Http\Controllers\rolController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\HistoriaController;






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

Route::get('/', function () {
    return view('Homepage');
});    





Route::middleware(['auth'])->group(function () {
    Route::get('Contrato/pdf', [ContratoController::class,'pdf'])->name('Contrato.pdf');
    Route::get('User/pdf', [UserController::class,'pdf'])->name('User.pdf');
    Route::get('Paciente/pdf', [PacienteController::class,'pdf'])->name('Paciente.pdf');
    Route::get('Agenda/pdf', [AgendaController::class,'pdf'])->name('Agenda.pdf');
    Route::get('Historia/pdf', [HistoriaController::class,'pdf'])->name('Historia.pdf');

    Route::get('/inicio', 'App\Http\Controllers\InicioController@index')->name('inicio');
    Route::resource('User', App\Http\Controllers\UserController::class);
    Route::resource('Agenda', App\Http\Controllers\AgendaController::class);
    Route::resource('Contrato', App\Http\Controllers\ContratoController::class);
    Route::resource('Historia', App\Http\Controllers\HistoriaController::class);
    Route::resource('Paciente', App\Http\Controllers\PacienteController::class);
    Route::resource('Permiso', App\Http\Controllers\PermisoController::class);
    Route::resource('Rol', App\Http\Controllers\RolController::class);
    Route::resource('Ep', App\Http\Controllers\EpController::class);
    Route::resource('rolespermisos', App\Http\Controllers\RolesPermisoController::class);
    Route::post('/reactivatePaciente', [PacienteController::class, 'reactivatePaciente']);
    Route::post('/reactivateUser', [UserController::class, 'reactivateUser']);



});

Route::get('/contratos/obtener-datos', 'App\Http\Controllers\ContratoController@obtenerDatos')->name('contratos.obtener-datos');
Route::put('/contrato/toggleEstado/{id}', 'App\Http\Controllers\ContratoController@toggleEstado')->name('Contrato.toggleEstado');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
