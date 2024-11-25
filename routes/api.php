<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controller
use App\Http\Controllers\API\ApartmentController;

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
    
    Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');

});
