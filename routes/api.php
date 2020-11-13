<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ModuleController;

Route::get('/roles/all', [RoleController::class, 'all'])->name('roles.all');
Route::get('/companys/all', [CompanyController::class, 'all'])->name('companys.all');
Route::get('/modules/all', [ModuleController::class, 'all'])->name('modules.all');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');

Route::resources([
    // 'users' => UserController::class,
    'posts' => PostController::class,
    'companys' => CompanyController::class,
    'roles' => RoleController::class,
    'modules' => ModuleController::class,
]);

