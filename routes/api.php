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

Route::resources([
    'users' => UserController::class,
    'posts' => PostController::class,
    'companys' => CompanyController::class,
    'roles' => RoleController::class,
    'modules' => ModuleController::class,
]);

