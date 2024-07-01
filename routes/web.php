<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Autenticador;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [SeriesController::class, 'index'])->name('series.index');



// Route::get('/series',[SeriesController::class,'index']);
// Route::get('/series/criar',[SeriesController::class,'create']);
// Route::post('/series/salvar',[SeriesController::class,'store']);
//ou
Route::resources([
    'series' => SeriesController::class,
]);
//  Route::resources([
//     'seasons' => SeasonsController::class, 
//  ]);

Route::middleware(Autenticador::class)->group(function () {
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');

    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
