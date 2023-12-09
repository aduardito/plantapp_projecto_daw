<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantTransactionController;

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

// admin admin@gmail.com
// kale.heaney@example.org
// macey16@example.com

Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('plants', PlantController::class);


Route::get('/transactions/search', [PlantTransactionController::class, 'search'])->name('transactions.search');
Route::get('/transactions/like', [PlantTransactionController::class, 'likePlant'])->name('transactions.like');
Route::get('/transactions/request', [PlantTransactionController::class, 'requestPlant'])->name('transactions.request');
Route::get('/transactions/show', [PlantTransactionController::class, 'showPlant'])->name('transactions.show');
Route::get('/transactions/choose', [PlantTransactionController::class, 'choosePlantOwner'])->name('transactions.choose');


Route::get('/transactions/splike', [PlantTransactionController::class, 'showPlantLike'])->name('transactions.splike');
Route::get('/transactions/spwant', [PlantTransactionController::class, 'showPlantWant'])->name('transactions.spwant');
Route::get('/transactions/spdislike', [PlantTransactionController::class, 'showPlantdislike'])->name('transactions.spdislike');
Route::get('/transactions/spunwant', [PlantTransactionController::class, 'showPlantUnwant'])->name('transactions.spunwant');
Route::get('/transactions/spaccept', [PlantTransactionController::class, 'showPlantAcceptDelivery'])->name('transactions.spaccept');
Route::get('/transactions/spreject', [PlantTransactionController::class, 'showPlantRejectDelivery'])->name('transactions.spreject');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
