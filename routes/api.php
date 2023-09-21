<?php
use App\Http\Controllers\Api\ApiPacienteController;
use App\Http\Controllers\Api\ApiAgendaController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiHistoriasController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class,'login']);
    Route::post('/logout', [AuthController::class,'logout']);


});



Route::group(['prefix' => 'agendas'], function () {
    Route::get('/', [ApiAgendaController::class, 'getAgenda']);
    Route::get('/{id}', [ApiAgendaController::class, 'getAgenda']);
    Route::post('/', [ApiAgendaController::class, 'createAgenda']);
    Route::put('/{id}', [ApiAgendaController::class, 'updateAgenda']);
    Route::delete('/{id}', [ApiAgendaController::class, 'deleteAgenda']);
    Route::get('/contract/{idContrato}', [ApiAgendaController::class, 'getAgendasByContractId']); 
    Route::get('/user/{userId}', [ApiAgendaController::class, 'getAgendasByUserId']); 

});


Route::group(['prefix' => 'paciente'], function () {
    Route::get('/', [ApiPacienteController::class, 'getPacientes']);
    Route::get('/{id}', [ApiPacienteController::class, 'getPacientes']);
    Route::post('/', [ApiPacienteController::class, 'createPaciente']);
    Route::put('/{id}', [ApiPacienteController::class, 'updatePaciente']);
    Route::delete('/{id}', [ApiPacienteController::class, 'deletePaciente']);
});


Route::group(['prefix' => 'user'], function () {
    Route::get('/', [ApiUserController::class, 'getUsers']);
    Route::get('/{id}', [ApiUserController::class, 'getUsers']);
    Route::get('/email/{email}', [ApiUserController::class, 'getUserByEmail']);
    Route::post('/', [ApiUserController::class, 'createUser']);
    Route::put('/{id}', [ApiUserController::class, 'updateUser']);
    Route::delete('/{id}', [ApiUserController::class, 'deleteUser']);
});

Route::group(['prefix' => 'historia'], function () {
    Route::get('/', [ApiHistoriasController::class, 'getHistorias']);
    Route::get('/{id}', [ApiHistoriasController::class, 'getHistorias']);
    Route::post('/', [ApiHistoriasController::class, 'createHistoria']);
    Route::put('/{id}', [ApiHistoriasController::class, 'updateHistoria']);
    Route::delete('/{id}', [ApiHistoriasController::class, 'deleteHistoria']);
    Route::get('/paciente/{pacientes_id}', [ApiHistoriasController::class, 'getHistoriasByPacienteId']);

});


