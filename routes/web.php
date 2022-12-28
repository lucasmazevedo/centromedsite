<?php

use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\ExameController;
use App\Http\Controllers\LaudoController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RelatorioController;
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


Auth::routes(['register'=> false]);

Route::get('/', [App\Http\Controllers\ExameController::class, 'index'])->name('home');

Route::controller(ExameController::class)->group(function () {
    Route::get('/exames', 'index')->name('exames.index');
    Route::get('/exames/cadastrar', 'create')->name('exames.create');
    Route::post('/exames/cadastrar', 'store')->name('exames.store');
    Route::get('/exame/{id}/editar', 'edit')->name('exames.edit');
    Route::post('/exame/{id}/editar', 'update')->name('exames.update');
    Route::post('/exame/{id}/cancelar', 'destroy')->name('exames.destroy');
    Route::get('/exame/{id}/capturar', 'captura')->name('exames.captura');

    Route::post('/exame/{id}/capturar', 'capturaImagem')->name('exames.capturaImagem');
    Route::get('/exame/{id}/imagens', 'recuperaImagens')->name('exames.recuperaImagens');
    Route::get('/exame/{id}/imagem/delete', 'deleteImagem')->name('exames.deleteImagem');
    Route::get('/exame/{id}/finalizar', 'finalizarCaptura')->name('exames.finalizarCaptura');
    Route::get('/exame/{id}/cancelar', 'cancelarCaptura')->name('exames.cancelarCaptura');

    Route::get('/exame/{id}/imprimir', 'printImagem')->name('exame.printImagem');
    Route::get('/exame/{id}/sendPacs', 'sendPacs')->name('exame.sendPacs');

    // Route::get('/exames/teste', 'show')->name('exames.show');
});

Route::controller(LaudoController::class)->group(function () {
    Route::get('/laudos', 'index')->name('laudos.index');
    Route::get('/laudos/{id}/laudar', 'create')->name('laudos.laudar');
    Route::post('/laudos/{id}/laudar', 'store')->name('laudos.gravar');
    Route::post('/laudos/{id}/laudar-assinar', 'salvarAssinar')->name('laudos.salvarAssinar');
    Route::get('/laudos/{id}/imprimir', 'printLaudo')->name('laudos.printLaudo');
});

Route::controller(PacienteController::class)->group(function () {
    Route::get('/pacientes', 'index')->name('pacientes.index');
    Route::get('/pacientes/{id}/editar', 'edit')->name('pacientes.edit');
    Route::post('/pacientes/{id}/editar', 'update')->name('pacientes.update');
    Route::get('/paciente/{id}/dados', 'dadosPaciente')->name('pacientes.dadosPaciente');
});

Route::controller(ConfiguracaoController::class)->group(function () {
    Route::get('/configuracoes', 'index')->name('configuracoes.index');
    Route::post('/configuracoes/atualizar', 'update')->name('configuracoes.update');
});

Route::controller(RelatorioController::class)->group(function () {
    Route::get('/relatorios', 'index')->name('relatorios.index');
    Route::get('/relatorios/pdf', 'gerarRelatorio')->name('relatorios.pdf');

    // Route::post('/configuracoes/atualizar', 'update')->name('configuracoes.update');
});

Route::controller(UserController::class)
        ->group(function () {
    Route::get('/usuarios', 'index')->name('usuarios.index');
    Route::get('/meus-dados', 'perfil')->name('usuarios.perfil');
    Route::post('/meus-dados', 'perfilUpdate')->name('usuarios.perfilupdate');
    // Route::get('/paciente/{id}/dados', 'dadosPaciente')->name('pacientes.dadosPaciente');
});


Route::prefix('mobile')->controller(MobileController::class)->group(function () {
    Route::get('/', 'index')->name('app.mobile');
    Route::get('/novoAg', 'create')->name('app.agendamento');
    Route::get('/novoAg/{id}/paciente', 'createPaciente')->name('app.agendamento.paciente');
    Route::get('/novoAg/{agenda}/paciente/exame/{paciente?}/', 'createExame')->name('app.agendamento.exame');

    Route::post('/cadastrarAgenda', 'store')->name('app.agendamento.store');
    Route::post('/cadastrarAgendaPaciente', 'storePaciente')->name('app.agendamento.storePaciente');

    Route::get('/agendamentos', 'show')->name('app.mobile.agendamentosR');


});
