<?php

use App\Http\Controllers\EntityController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BuildController;

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
    return view('home');
})->name('home');

Route::get('/create', function() {
    return view('build-table');
});

Route::get('/login', function() {
    return view('login');
});

Route::post('/projects/{project_id}/create-entity', [ EntityController::class, 'store' ])->name('dashboard.store-entity');
Route::get('/projects/{project_id}/entity/{entity}', [ EntityController::class, 'show' ])->name('dashboard.show-entity');
Route::get('/edit-entity/{entity}', [EntityController::class, 'edit'])->name('entity.edit');
Route::post('/edit-entity/{entity}', [EntityController::class, 'update'])->name('entity.update');

//register and update account details routes
Route::resource('users', UserController::class)->only([
    'store', 'update',
    'edit',
]);

//resource routes for managing projects

Route::resource('projects', ProjectController::class)->only([
    'store', 'destroy', 'update',
    'index', 'edit', 'show' //these are all partial templates to be shown in the dashboard body
])->middleware([Authenticate::class]);

Route::get('/dashboard', [ProjectController::class, 'none_selected'])->middleware([Authenticate::class])->name('projects.none_selected');
Route::get('/_projects/{project}/edit/editor', [ProjectController::class, 'editor'])->middleware([Authenticate::class])->name('projects.editor');
Route::get('/_projects/{project}/edit/settings', [ProjectController::class, 'settings'])->middleware([Authenticate::class])->name('projects.settings');
Route::get('/_projects/{project}/builds', [ProjectController::class, 'builds'])->middleware([Authenticate::class])->name('projects.builds');
//must use _ above to avoid route conflicts

//routes for managing builds
Route::resource('builds', BuildController::class)->only([
    'store', 'destroy'
])->middleware([Authenticate::class]);
Route::get('/_builds/{build}/download', [BuildController::class, 'download'])->middleware([Authenticate::class])->name('builds.download');

//auth routes
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


