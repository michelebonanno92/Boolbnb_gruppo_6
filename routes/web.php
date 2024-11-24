<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\ApartmentController as AdminApartmentController;

use App\Http\Controllers\Admin\ServiceController;

//importato secondo apartment controller per errore a riga 45. da rivedere
use App\Http\Controllers\ApartmentController;



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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');
    
    //rotta controller apartments
    Route::resource('apartments', AdminApartmentController::class);

    //rotta controller service
    Route::resource('services', ServiceController::class);

});

//le 3 rotte sottostanti vengono segnalate come errore 
Route::resource('homepage', ApartmentController::class);

Route::post('/search-address', [ApartmentController::class, 'searchAddress'])->name('search.address');
Route::post('/save-coordinates', [ApartmentController::class, 'saveCoordinates'])->name('save.coordinates');



require __DIR__.'/auth.php';
