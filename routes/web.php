<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\JenisSampahController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kalkulator',[KalkulatorController::class,'index'])->middleware('auth')->name('kalkulator');
Route::post('/kalkulator',[KalkulatorController::class,'calculate'])->middleware('auth')->name('kalkulasi');

Route::resource('sampah', SampahController::class)->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';

// Auth::routes();
