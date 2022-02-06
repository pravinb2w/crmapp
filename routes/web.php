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

    Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers');
    Route::post('/customers/add', [App\Http\Controllers\CustomerController::class, 'add_edit'])->name('customers.add');
    Route::post('/customers/view', [App\Http\Controllers\CustomerController::class, 'view'])->name('customers.view');
    Route::post('/customers/save', [App\Http\Controllers\CustomerController::class, 'save'])->name('customers.save');
    Route::post('/customers/list', [App\Http\Controllers\CustomerController::class, 'ajax_list'])->name('customers.list');
    Route::post('/customers/delete', [App\Http\Controllers\CustomerController::class, 'delete'])->name('customers.delete');
    Route::post('/customers/status', [App\Http\Controllers\CustomerController::class, 'change_status'])->name('customers.status');
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');

        //users route
        Route::get('/cms', [App\Http\Controllers\UserController::class, 'index'])->name('cms');
        Route::post('/cms/add', [App\Http\Controllers\UserController::class, 'add_edit'])->name('cms.add');
        Route::post('/cms/save', [App\Http\Controllers\UserController::class, 'save'])->name('cms.save');
        Route::post('/cms/list', [App\Http\Controllers\UserController::class, 'ajax_list'])->name('cms.list');
        Route::post('/cms/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('cms.delete');
        Route::post('/cms/status', [App\Http\Controllers\UserController::class, 'change_status'])->name('cms.status');
        //users route
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::post('/users/add', [App\Http\Controllers\UserController::class, 'add_edit'])->name('users.add');
        Route::post('/users/save', [App\Http\Controllers\UserController::class, 'save'])->name('users.save');
        Route::post('/users/list', [App\Http\Controllers\UserController::class, 'ajax_list'])->name('users.list');
        Route::post('/users/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
        Route::post('/users/status', [App\Http\Controllers\UserController::class, 'change_status'])->name('users.status');

        //roles route
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
        Route::post('/roles/add', [App\Http\Controllers\RoleController::class, 'add_edit'])->name('roles.add');
        Route::post('/roles/save', [App\Http\Controllers\RoleController::class, 'save'])->name('roles.save');
        Route::post('/roles/list', [App\Http\Controllers\RoleController::class, 'ajax_list'])->name('roles.list');
        Route::post('/roles/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
        Route::post('/roles/status', [App\Http\Controllers\RoleController::class, 'change_status'])->name('roles.status');

         //subscriptions route
        Route::get('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions');
        Route::post('/subscriptions/add', [App\Http\Controllers\SubscriptionController::class, 'add_edit'])->name('subscriptions.add');
        Route::post('/subscriptions/view', [App\Http\Controllers\SubscriptionController::class, 'view'])->name('subscriptions.view');
        Route::post('/subscriptions/save', [App\Http\Controllers\SubscriptionController::class, 'save'])->name('subscriptions.save');
        Route::post('/subscriptions/list', [App\Http\Controllers\SubscriptionController::class, 'ajax_list'])->name('subscriptions.list');
        Route::post('/subscriptions/delete', [App\Http\Controllers\SubscriptionController::class, 'delete'])->name('subscriptions.delete');
        Route::post('/subscriptions/status', [App\Http\Controllers\SubscriptionController::class, 'change_status'])->name('subscriptions.status');

        //company subscriptions route
         //subscriptions route
        Route::get('/company-subscriptions', [App\Http\Controllers\CompanySubscriptionController::class, 'index'])->name('company-subscriptions');
        Route::post('/company-subscriptions/add', [App\Http\Controllers\CompanySubscriptionController::class, 'add_edit'])->name('company-subscriptions.add');
        Route::post('/company-subscriptions/view', [App\Http\Controllers\CompanySubscriptionController::class, 'view'])->name('company-subscriptions.view');
        Route::post('/company-subscriptions/save', [App\Http\Controllers\CompanySubscriptionController::class, 'save'])->name('company-subscriptions.save');
        Route::post('/company-subscriptions/list', [App\Http\Controllers\CompanySubscriptionController::class, 'ajax_list'])->name('company-subscriptions.list');
        Route::post('/company-subscriptions/delete', [App\Http\Controllers\CompanySubscriptionController::class, 'delete'])->name('company-subscriptions.delete');
        Route::post('/company-subscriptions/status', [App\Http\Controllers\CompanySubscriptionController::class, 'change_status'])->name('company-subscriptions.status');

        Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company');
        Route::post('/company/add', [App\Http\Controllers\CompanyController::class, 'add_edit'])->name('company.add');
        Route::post('/company/view', [App\Http\Controllers\CompanyController::class, 'view'])->name('company.view');
        Route::post('/company/save', [App\Http\Controllers\CompanyController::class, 'save'])->name('company.save');
        Route::post('/company/list', [App\Http\Controllers\CompanyController::class, 'ajax_list'])->name('company.list');
        Route::post('/company/delete', [App\Http\Controllers\CompanyController::class, 'delete'])->name('company.delete');
        Route::post('/company/status', [App\Http\Controllers\CompanyController::class, 'change_status'])->name('company.status');

        Route::get('/pagetype', [App\Http\Controllers\PageTypeController::class, 'index'])->name('pagetype');
        Route::post('/pagetype/add', [App\Http\Controllers\PageTypeController::class, 'add_edit'])->name('pagetype.add');
        Route::post('/pagetype/view', [App\Http\Controllers\PageTypeController::class, 'view'])->name('pagetype.view');
        Route::post('/pagetype/save', [App\Http\Controllers\PageTypeController::class, 'save'])->name('pagetype.save');
        Route::post('/pagetype/list', [App\Http\Controllers\PageTypeController::class, 'ajax_list'])->name('pagetype.list');
        Route::post('/pagetype/delete', [App\Http\Controllers\PageTypeController::class, 'delete'])->name('pagetype.delete');
        Route::post('/pagetype/status', [App\Http\Controllers\PageTypeController::class, 'change_status'])->name('pagetype.status');

        Route::get('/dealstages', [App\Http\Controllers\DealStageController::class, 'index'])->name('dealstages');
        Route::post('/dealstages/add', [App\Http\Controllers\DealStageController::class, 'add_edit'])->name('dealstages.add');
        Route::post('/dealstages/view', [App\Http\Controllers\DealStageController::class, 'view'])->name('dealstages.view');
        Route::post('/dealstages/save', [App\Http\Controllers\DealStageController::class, 'save'])->name('dealstages.save');
        Route::post('/dealstages/list', [App\Http\Controllers\DealStageController::class, 'ajax_list'])->name('dealstages.list');
        Route::post('/dealstages/delete', [App\Http\Controllers\DealStageController::class, 'delete'])->name('dealstages.delete');
        Route::post('/dealstages/status', [App\Http\Controllers\DealStageController::class, 'change_status'])->name('dealstages.status');

        Route::get('/leadtype', [App\Http\Controllers\LeadTypeController::class, 'index'])->name('leadtype');
        Route::post('/leadtype/add', [App\Http\Controllers\LeadTypeController::class, 'add_edit'])->name('leadtype.add');
        Route::post('/leadtype/view', [App\Http\Controllers\LeadTypeController::class, 'view'])->name('leadtype.view');
        Route::post('/leadtype/save', [App\Http\Controllers\LeadTypeController::class, 'save'])->name('leadtype.save');
        Route::post('/leadtype/list', [App\Http\Controllers\LeadTypeController::class, 'ajax_list'])->name('leadtype.list');
        Route::post('/leadtype/delete', [App\Http\Controllers\LeadTypeController::class, 'delete'])->name('leadtype.delete');
        Route::post('/leadtype/status', [App\Http\Controllers\LeadTypeController::class, 'change_status'])->name('leadtype.status');

        Route::any('/leadsource', [App\Http\Controllers\LeadSourceController::class, 'index'])->name('leadsource');
        Route::post('/leadsource/add', [App\Http\Controllers\LeadSourceController::class, 'add_edit'])->name('leadsource.add');
        Route::post('/leadsource/view', [App\Http\Controllers\LeadSourceController::class, 'view'])->name('leadsource.view');
        Route::post('/leadsource/save', [App\Http\Controllers\LeadSourceController::class, 'save'])->name('leadsource.save');
        Route::post('/leadsource/list', [App\Http\Controllers\LeadSourceController::class, 'ajax_list'])->name('leadsource.list');
        Route::post('/leadsource/delete', [App\Http\Controllers\LeadSourceController::class, 'delete'])->name('leadsource.delete');
        Route::post('/leadsource/status', [App\Http\Controllers\LeadSourceController::class, 'change_status'])->name('leadsource.status');

        Route::get('/country', [App\Http\Controllers\CountryController::class, 'index'])->name('country');
        Route::post('/country/add', [App\Http\Controllers\CountryController::class, 'add_edit'])->name('country.add');
        Route::post('/country/view', [App\Http\Controllers\CountryController::class, 'view'])->name('country.view');
        Route::post('/country/save', [App\Http\Controllers\CountryController::class, 'save'])->name('country.save');
        Route::post('/country/list', [App\Http\Controllers\CountryController::class, 'ajax_list'])->name('country.list');
        Route::post('/country/delete', [App\Http\Controllers\CountryController::class, 'delete'])->name('country.delete');
        Route::post('/country/status', [App\Http\Controllers\CountryController::class, 'change_status'])->name('country.status');

        

    });

    // Products Routes
    Route::get('/products', function () {
        return view('crm.products.index');
    })->name("products.index");

});