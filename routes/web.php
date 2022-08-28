<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FederacionAppController;

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

Route::get('/', function() {
    return view('login');
});

Route::get('/home', function() {
    return view('main');
});

Route::get('/plantilla', function() {
    return view('main');
});

// API Login
Route::post('/api/user/signUp', [UserController::class, 'signUp']);
Route::post('/api/user/login', [UserController::class, 'login']);
Route::post('/api/user/logout', [UserController::class, 'logout']);
Route::get('/api/user/data', [UserController::class, 'user']);

//API User
Route::get('/api/user/getTeams', [TeamController::class, 'getTeamsByUserID']);

//API Federacion App
Route::get('/api/fed/getAll', [FederacionAppController::class, 'getFederacionAppAll']);
Route::post('/api/fed/getLogoByID', [FederacionAppController::class, 'getFederacionAppLogoByID']);

//API Equipo
Route::post('/api/team/create', [TeamController::class, 'createTeam']);

//API Jugadores
Route::post('/api/player/create', [PlayerController::class, 'createPlayer']);
Route::post('/api/player/getPlayers', [PlayerController::class, 'getPlayersByTeamID']);
Route::post('/api/player/upload-image', [PlayerController::class, 'uploadImagen']);