<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\VaccineRegistrationController;
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

Route::get('/registration', [VaccineRegistrationController::class, 'registration'])->name('registration');

Route::post('/registration', [VaccineRegistrationController::class, 'completeRegistration'])->name('complete-registration');
Route::get('/success', [VaccineRegistrationController::class, 'success'])->name('registration.success');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/get-status-by-nid', [SearchController::class, 'getStatusByNid'])->name('getStatusByNid');


// Route::resource('registrations', []);
