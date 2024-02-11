<?php

use App\Http\Controllers\EntityController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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

Route::get('/create', function() {
    return view('build-table');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('/builds/{build_id}/entities', [ EntityController::class, 'index' ]);
Route::get('/builds/{build_id}/create-entity', [ EntityController::class, 'create' ]);
Route::post('/builds/{build_id}/create-entity', [ EntityController::class, 'store' ]);

//register and update account details routes
Route::resource('users', UserController::class)->only([
    'store', 'update'
]);

//auth routes
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

