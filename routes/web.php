<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\ApartmentController as AdminApartmentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorshipController as AdminSponsorshipController;


use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ViewController;

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

Route::get('/', [AdminMainController::class, 'showDashboard'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'showDashboard'])->name('dashboard');
    // Route::get('/dashboard', [ViewController::class, 'index'])->name('view.index');
    
    //rotta controller apartments
    Route::resource('apartments', AdminApartmentController::class);

    Route::get('apartments/{apartment}/messages', [AdminApartmentController::class, 'messages'])->name('apartments.messages');

    //rotta controller service
    Route::resource('services', ServiceController::class);

    //rotta controller messaggi
    Route::resource('messages', MessageController::class);
    
    // rotte per le sponzorizzazioni e pagamento 
    Route::get('/sponsorships', [AdminSponsorshipController::class, 'index'])->name('sponsorships.index');
    Route::post('/sponsorships', [AdminSponsorshipController::class, 'store'])->name('sponsorships.store');

    // Route::get('/payment/{apartmentId}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    // Route::post('/payment', [PaymentController::class, 'createTransaction'])->name('payment.create');

});

//le 3 rotte sottostanti vengono segnalate come errore 
Route::resource('homepage', ApartmentController::class);

Route::post('/search-address', [ApartmentController::class, 'searchAddress'])->name('search.address');
Route::post('/save-coordinates', [ApartmentController::class, 'saveCoordinates'])->name('save.coordinates');



require __DIR__.'/auth.php';
