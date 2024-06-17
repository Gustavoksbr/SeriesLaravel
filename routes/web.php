<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::resources([
//     'series' => SeriesController::class,
// ]);

Route::get('/series',[SeriesController::class,'index']);
Route::get('/series/criar',[SeriesController::class,'create']);
Route::post('/series/salvar',[SeriesController::class,'store']);


