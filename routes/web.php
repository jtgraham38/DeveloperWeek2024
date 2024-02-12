<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

use App\Http\Middleware\Authenticate;

use App\Models\Project;

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

//resource routes for managing builds
Route::resource('projects', ProjectController::class)->only([
    'store', 'destroy'
])->middleware([Authenticate::class]);

//auth routes
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//dashboard screen routes
Route::get('/dashboard', function(){
    return view('layouts.dashboard');
})->middleware([Authenticate::class])->name('dashboard');

Route::get('/index', function () {    //todo: update path
    return view('dashboard.index');
})->middleware([Authenticate::class])->name('dashboard.index');
Route::get('/builder', function () {    //todo: update path
    return view('dashboard.builder');
})->middleware([Authenticate::class])->name('dashboard.builder');
Route::get('/settings', function () {   //todo: update path
    return view('dashboard.settings');
})->middleware([Authenticate::class])->name('dashboard.settings');