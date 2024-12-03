<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controller
use App\Http\Controllers\API\ApartmentController as ApiApartmentController;
use App\Http\Controllers\API\MessageController as ApiMessageController;
use App\Http\Controllers\API\ServiceController as ApiServiceController;

use App\Http\Controllers\API\ViewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->group(function () {

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::resource('apartments', ApiApartmentController::class)->only([
        'index',
        'show'
    ]);

    // Route::post('/new-message', [MessageController::class, 'newMessage'])->name('new-message');
    Route::post('/new-message', [ApiMessageController::class, 'sendMessage'])->name('api.new-message');
    
    // visualizzazioni
    Route::post('/new-view', [ViewController::class, 'recordView']);

    Route::get('/services', [ApiServiceController::class, 'index'])->name('api.servises');


    
});
