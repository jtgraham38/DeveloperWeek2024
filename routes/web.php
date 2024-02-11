<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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
    return view('welcome');
});

//register and update account details routes
Route::resource('users', UserController::class)->only([
    'store', 'update'
]);

//auth routes
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//dashboard screen routes
Route::get('/builder', function () {
    return view('dashboard.builder');
})->name('dashboard.builder');
Route::get('/settings', function () {
    return view('dashboard.settings');
})->name('dashboard.settings');