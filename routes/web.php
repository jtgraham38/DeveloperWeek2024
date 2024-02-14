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
})->name('welcome');

//register and update account details routes
Route::resource('users', UserController::class)->only([
    'store', 'update',
    'edit',
]);

//resource routes for managing projects

Route::resource('projects', ProjectController::class)->only([
    'store', 'destroy',
    'index', 'edit', 'show' //these are all partial templates to be shown in the dashboard body
])->middleware([Authenticate::class]);

Route::get('/dashboard', [ProjectController::class, 'none_selected'])->middleware([Authenticate::class])->name('projects.none_selected');
Route::get('/_projects/{project}/edit/editor', [ProjectController::class, 'editor'])->middleware([Authenticate::class])->name('projects.editor');
Route::get('/_projects/{project}/edit/settings', [ProjectController::class, 'settings'])->middleware([Authenticate::class])->name('projects.settings');
//must use _ above to avoid route conflicts

//auth routes
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
