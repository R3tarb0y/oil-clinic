<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OilController;
use App\Http\Controllers\CondemningController;
use App\Http\Controllers\ExportController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(OilController::class)->prefix('oil')->group(function () {
        Route::get('', 'index')->name('oil');
        Route::post('store', 'store')->name('oil.store');
        Route::get('show/{id}', 'show')->name('oil.show');
        Route::get('/{id}/edit', [OilController::class, 'edit'])->name('oil.edit');
        Route::put('/oil/{id}', [OilController::class, 'update'])->name('oil.update');
        // Route::get('/oil/{id}/{table}/edit', 'OilController@edit');
        Route::delete('destroy/{id}', 'destroy')->name('oil.destroy');
        Route::get('/oil/export/csv/{condemIDs}', 'App\Http\Controllers\OilController@exportCsv')->name('oil.export.csv');
        Route::get('/oil/export/pdf/{condemIDs}', 'App\Http\Controllers\OilController@exportPdf')->name('oil.export.pdf');
        Route::get('/oil/download/pdf', 'App\Http\Controllers\OilController@downloadPdf')->name('oil.download.pdf');

    });


    Route::get('/oil', [OilController::class, 'index'])->name('oil');


    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
