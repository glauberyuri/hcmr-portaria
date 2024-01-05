<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Route::get('/dashboard', [\App\Http\Controllers\Controller::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/home', [\App\Http\Controllers\Controller::class, 'home'])->middleware(['auth', 'verified'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/internados', [\App\Http\Controllers\Controller::class, 'SearchPaciente'])->name('pacientesInternados');
    Route::get('/visitantes', [\App\Http\Controllers\Controller::class, 'listaVisitantes'])->name('listaVisitantes');
    Route::get('/getVisitante', [\App\Http\Controllers\Controller::class, 'getVisitante'])->name('getVisitante');
    Route::get('/getVisitanteList', [\App\Http\Controllers\Controller::class, 'getVisitanteList'])->name('getVisitanteList');
    Route::post('/storeVisitante',[\App\Http\Controllers\VisitanteController::class, 'store'])->name('store.visitante');
    Route::post('/storeportaria',[\App\Http\Controllers\PortariaController::class, 'store'])->name('store.portaria');
    Route::get('/getPaciente', [\App\Http\Controllers\Controller::class, 'GetPaciente'])->name('get.paciente');
});

require __DIR__.'/auth.php';
