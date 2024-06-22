<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});



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
Route::get('/series/{series}/seasons',[SeasonsController::class,'index'])->name('seasons.index');

