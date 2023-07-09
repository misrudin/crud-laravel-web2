<?php

use App\Http\Controllers\CityController;
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

Route::get('/', [CityController::class, 'index'])->name('city.index');

Route::get('/create', [CityController::class, 'create'])->name('city.create');
Route::get('/edit/{id}', [CityController::class, 'edit'])->name('city.edit');

Route::get('/export', [CityController::class, 'export'])->name('city.export');

Route::post('/', [CityController::class, 'store'])->name('city.store');
Route::put('/{id}', [CityController::class, 'update'])->name('city.update');

Route::delete('/{id}', [CityController::class, 'destroy'])->name('city.destroy');