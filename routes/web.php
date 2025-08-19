<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas web para sua aplicação. Essas
| rotas são carregadas pelo RouteServiceProvider e todas elas
| recebem o grupo de middleware "web" atribuído.
|
*/

Route::get('/', [AudioController::class, 'index'])->name('audio.index');



Route::post('/convert', [AudioController::class, 'convert'])->name('audio.convert');