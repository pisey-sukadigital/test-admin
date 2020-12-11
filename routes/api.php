<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ModuleController;
use App\Http\Controllers\API\LogActivityController;

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::group(['prefix' => 'users'], function () {
    Route::post('add', [UserController::class, 'store'])->name('users.add');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
});

Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
Route::group(['prefix' => 'modules'], function () {
    Route::post('add', [ModuleController::class, 'store'])->name('modules.add');
    Route::get('edit/{id}', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::post('update/{id}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('delete/{id}', [ModuleController::class, 'destroy'])->name('modules.delete');
});


Route::get('/roles/all', [RoleController::class, 'all'])->name('roles.all');
Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::group(['prefix' => 'roles'], function () {
    Route::post('add', [RoleController::class, 'store'])->name('roles.add');
    Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('delete/{id}', [RoleController::class, 'destroy'])->name('roles.delete');
});


Route::get('/roles/permission', [RoleController::class, 'allPermission'])->name('roles.allPermission');
Route::get('/log_activity', [LogActivityController::class, 'index'])->name('log_activity.index');
Route::resources([
    'companys' => CompanyController::class,
]);


