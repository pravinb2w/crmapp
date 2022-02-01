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
Route::middleware([SetViewVariable::class, 'auth'])->group(function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::get('/account/change-password',[App\Http\Controllers\AccountController::class, 'index'])->name('change_password');
    Route::post('/account/settings/tab', [App\Http\Controllers\AccountController::class, 'get_settings_tab'])->name('settings.tab');
    Route::post('/account/save', [App\Http\Controllers\AccountController::class, 'save'])->name('account.save');
    Route::post('/company/save', [App\Http\Controllers\AccountController::class, 'company_save'])->name('account.company.save');

    Route::prefix('settings')->group(function () {
        //users route
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::post('/users/add', [App\Http\Controllers\UserController::class, 'add_edit'])->name('users.add');
        Route::post('/users/save', [App\Http\Controllers\UserController::class, 'save'])->name('users.save');
        Route::post('/users/list', [App\Http\Controllers\UserController::class, 'ajax_list'])->name('users.list');
        Route::post('/users/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
        //roles route
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
        Route::post('/roles/add', [App\Http\Controllers\RoleController::class, 'add_edit'])->name('roles.add');
        Route::post('/roles/save', [App\Http\Controllers\RoleController::class, 'save'])->name('roles.save');
        Route::post('/roles/list', [App\Http\Controllers\RoleController::class, 'ajax_list'])->name('roles.list');
        Route::post('/roles/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
         //subscriptions route
        Route::get('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions');
        Route::post('/subscriptions/add', [App\Http\Controllers\SubscriptionController::class, 'add_edit'])->name('subscriptions.add');
        Route::post('/subscriptions/view', [App\Http\Controllers\SubscriptionController::class, 'view'])->name('subscriptions.view');
        Route::post('/subscriptions/save', [App\Http\Controllers\SubscriptionController::class, 'save'])->name('subscriptions.save');
        Route::post('/subscriptions/list', [App\Http\Controllers\SubscriptionController::class, 'ajax_list'])->name('subscriptions.list');
        Route::post('/subscriptions/delete', [App\Http\Controllers\SubscriptionController::class, 'delete'])->name('subscriptions.delete');
        //company subscriptions route
         //subscriptions route
        Route::get('/company-subscriptions', [App\Http\Controllers\CompanySubscriptionController::class, 'index'])->name('company-subscriptions');
        Route::post('/company-subscriptions/add', [App\Http\Controllers\CompanySubscriptionController::class, 'add_edit'])->name('company-subscriptions.add');
        Route::post('/company-subscriptions/view', [App\Http\Controllers\CompanySubscriptionController::class, 'view'])->name('company-subscriptions.view');
        Route::post('/company-subscriptions/save', [App\Http\Controllers\CompanySubscriptionController::class, 'save'])->name('company-subscriptions.save');
        Route::post('/company-subscriptions/list', [App\Http\Controllers\CompanySubscriptionController::class, 'ajax_list'])->name('company-subscriptions.list');
        Route::post('/company-subscriptions/delete', [App\Http\Controllers\CompanySubscriptionController::class, 'delete'])->name('company-subscriptions.delete');
    });
});