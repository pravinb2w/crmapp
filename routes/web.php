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

Route::get('/', [App\Http\Controllers\LandingController::class, 'index']);
Route::post('/enquiry', [App\Http\Controllers\LandingController::class, 'enquiry_save'])->name('enquiry.save');

Auth::routes();
Route::middleware([SetViewVariable::class, 'auth'])->group(function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/deals-dashboard', [App\Http\Controllers\HomeController::class, 'dealsIndex'])->name('deals-dashboard');
    Route::get('/deals-pipelines', [App\Http\Controllers\HomeController::class, 'dealsPipeline'])->name('deals-pipeline');

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

    Route::post('/autocomplete_org', [App\Http\Controllers\CustomerController::class, 'autocomplete_organization'])->name('autocomplete_org');
    Route::post('/autocomplete_org_save', [App\Http\Controllers\CustomerController::class, 'autocomplete_organization_save'])->name('autocomplete_org_save');

    Route::post('/autocomplete_customer', [App\Http\Controllers\CustomerController::class, 'autocomplete_customer'])->name('autocomplete_customer');
    Route::post('/autocomplete_customer_save', [App\Http\Controllers\CustomerController::class, 'autocomplete_customer_save'])->name('autocomplete_customer_save');

    Route::post('/autocomplete_lead_deal', [App\Http\Controllers\LeadController::class, 'autocomplete_lead_deal'])->name('autocomplete_lead_deal');
    Route::post('/autocomplete_lead_deal_set', [App\Http\Controllers\LeadController::class, 'autocomplete_lead_deal_set'])->name('autocomplete_lead_deal_set');

    //Activities
    Route::prefix('activities')->group(function () {
        Route::get('/', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities');
        Route::post('/add', [App\Http\Controllers\ActivityController::class, 'add_edit'])->name('activities.add');
        Route::post('/save', [App\Http\Controllers\ActivityController::class, 'save'])->name('activities.save');
        Route::post('/list', [App\Http\Controllers\ActivityController::class, 'ajax_list'])->name('activities.list');
        Route::post('/delete', [App\Http\Controllers\ActivityController::class, 'delete'])->name('activities.delete');
        Route::post('/status', [App\Http\Controllers\ActivityController::class, 'change_status'])->name('activities.status');
        Route::post('/mark_as_done', [App\Http\Controllers\ActivityController::class, 'mark_as_done'])->name('activities.mark_as_done');
    });
    //pages route
    Route::prefix('pages')->group(function () {
        Route::get('/', [App\Http\Controllers\CmsController::class, 'index'])->name('pages');
        Route::get('/add/{id?}', [App\Http\Controllers\CmsController::class, 'add'])->name('pages.add');
        Route::post('/save', [App\Http\Controllers\CmsController::class, 'save'])->name('pages.save');
        Route::post('/list', [App\Http\Controllers\CmsController::class, 'ajax_list'])->name('pages.list');
        Route::post('/delete', [App\Http\Controllers\CmsController::class, 'delete'])->name('pages.delete');
        Route::post('/status', [App\Http\Controllers\CmsController::class, 'change_status'])->name('pages.status');
    });
    //products route
    Route::prefix('products')->group(function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
        Route::post('/add', [App\Http\Controllers\ProductController::class, 'add_edit'])->name('products.add');
        Route::post('/save', [App\Http\Controllers\ProductController::class, 'save'])->name('products.save');
        Route::post('/list', [App\Http\Controllers\ProductController::class, 'ajax_list'])->name('products.list');
        Route::post('/delete', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.delete');
        Route::post('/status', [App\Http\Controllers\ProductController::class, 'change_status'])->name('products.status');
    });
    //leads route
    Route::prefix('leads')->group(function () {
        Route::get('/', [App\Http\Controllers\LeadController::class, 'index'])->name('leads');
        Route::get('/view/{id}', [App\Http\Controllers\LeadController::class, 'view'])->name('leads.view');
        Route::post('/add', [App\Http\Controllers\LeadController::class, 'add_edit'])->name('leads.add');
        Route::post('/save', [App\Http\Controllers\LeadController::class, 'save'])->name('leads.save');
        Route::post('/activity/save', [App\Http\Controllers\LeadController::class, 'activity_save'])->name('leads.save-activity');
        Route::post('/notes/save', [App\Http\Controllers\LeadController::class, 'notes_save'])->name('leads.save-notes');
        Route::post('/list', [App\Http\Controllers\LeadController::class, 'ajax_list'])->name('leads.list');
        Route::post('/delete', [App\Http\Controllers\LeadController::class, 'delete'])->name('leads.delete');
        Route::post('/status', [App\Http\Controllers\LeadController::class, 'change_status'])->name('leads.status');
        Route::post('/refresh/timeline', [App\Http\Controllers\LeadController::class, 'refresh_timeline'])->name('leads.refresh-timeline');
        Route::post('/activity/delete', [App\Http\Controllers\LeadController::class, 'delete_activity'])->name('leads.activity-delete');

    });
    //leads route
    Route::prefix('deals')->group(function () {
        Route::get('/', [App\Http\Controllers\DealsController::class, 'index'])->name('deals');
        Route::get('/view/{id}', [App\Http\Controllers\DealsController::class, 'view'])->name('deals.view');
        Route::post('/add', [App\Http\Controllers\DealsController::class, 'add_edit'])->name('deals.open_add_modal');
        Route::post('/save', [App\Http\Controllers\DealsController::class, 'save'])->name('deals.save');

    });
    //tasks route
    Route::prefix('tasks')->group(function () {
        Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
        Route::post('/add', [App\Http\Controllers\TaskController::class, 'add_edit'])->name('tasks.add');
        Route::post('/save', [App\Http\Controllers\TaskController::class, 'save'])->name('tasks.save');
        Route::post('/list', [App\Http\Controllers\TaskController::class, 'ajax_list'])->name('tasks.list');
        Route::post('/delete', [App\Http\Controllers\TaskController::class, 'delete'])->name('tasks.delete');
        Route::post('/status', [App\Http\Controllers\TaskController::class, 'change_status'])->name('tasks.status');
    });

    // Deals Routes
    Route::prefix('deals')->group(function () {
        Route::get('/', [App\Http\Controllers\DealsController::class, 'index'])->name('deals'); 
        Route::get('/create', [App\Http\Controllers\DealsController::class, 'create'])->name('create-deal'); 
        Route::get('/view', [App\Http\Controllers\DealsController::class, 'show'])->name('view-deal'); 

    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
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
 
        Route::get('/organizations', [App\Http\Controllers\OrganizationController::class, 'index'])->name('organizations');
        Route::post('/organizations/add', [App\Http\Controllers\OrganizationController::class, 'add_edit'])->name('organizations.add');
        Route::post('/organizations/view', [App\Http\Controllers\OrganizationController::class, 'view'])->name('organizations.view');
        Route::post('/organizations/save', [App\Http\Controllers\OrganizationController::class, 'save'])->name('organizations.save');
        Route::post('/organizations/list', [App\Http\Controllers\OrganizationController::class, 'ajax_list'])->name('organizations.list');
        Route::post('/organizations/delete', [App\Http\Controllers\OrganizationController::class, 'delete'])->name('organizations.delete');
        Route::post('/organizations/status', [App\Http\Controllers\OrganizationController::class, 'change_status'])->name('organizations.status');

        Route::get('/teams', [App\Http\Controllers\TeamController::class, 'index'])->name('teams');
        Route::post('/teams/add', [App\Http\Controllers\TeamController::class, 'add_edit'])->name('teams.add');
        Route::post('/teams/view', [App\Http\Controllers\TeamController::class, 'view'])->name('teams.view');
        Route::post('/teams/save', [App\Http\Controllers\TeamController::class, 'save'])->name('teams.save');
        Route::post('/teams/list', [App\Http\Controllers\TeamController::class, 'ajax_list'])->name('teams.list');
        Route::post('/teams/delete', [App\Http\Controllers\TeamController::class, 'delete'])->name('teams.delete');
        Route::post('/teams/status', [App\Http\Controllers\TeamController::class, 'change_status'])->name('teams.status');

    });


});