<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetViewVariable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing.landing');
});

Auth::routes();
Route::middleware([SetViewVariable::class])->group(function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::get('/account/change-password',[App\Http\Controllers\AccountController::class, 'index'])->name('change_password');
    Route::post('/account/settings/tab', [App\Http\Controllers\AccountController::class, 'get_settings_tab'])->name('settings.tab');
    Route::post('/account/save', [App\Http\Controllers\AccountController::class, 'save'])->name('account.save');
    Route::post('/company/save', [App\Http\Controllers\AccountController::class, 'company_save'])->name('account.company.save');

    Route::prefix('settings')->group(function () {
        //users route
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::post('/users/add', [App\Http\Controllers\UserController::class, 'index'])->name('users.add');
        Route::post('/users/save', [App\Http\Controllers\UserController::class, 'save'])->name('users.save');
        Route::post('/users/list', [App\Http\Controllers\UserController::class, 'ajax_list'])->name('users.list');
        Route::post('/users/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
        //roles route
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
        Route::post('/roles/add', [App\Http\Controllers\RoleController::class, 'add_edit'])->name('roles.add');
        Route::post('/roles/save', [App\Http\Controllers\RoleController::class, 'save'])->name('roles.save');
        Route::post('/roles/list', [App\Http\Controllers\RoleController::class, 'ajax_list'])->name('roles.list');
        Route::post('/roles/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
    });
});