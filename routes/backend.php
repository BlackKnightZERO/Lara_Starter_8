<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
ROute::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
ROute::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');