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
    return  redirect(route('landing.index'));
});

Route::get('/send-mail', [App\Http\Controllers\MailController::class, 'sendMail'])->name('send');

Route::get('/devlogin', [App\Http\Controllers\Auth\LoginController::class, 'login_page'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/login/submit', [App\Http\Controllers\Auth\LoginController::class, 'check_login'])->name('login.submit');

Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);
Route::get('/crm/{permalink?}', [App\Http\Controllers\LandingController::class, 'index'])->name('landing.index');
Route::post('/enquiry', [App\Http\Controllers\LandingController::class, 'enquiry_save'])->name('enquiry.save');
Route::get('/approve/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'approve_invoice'])->name('approve-invoice');
Route::get('/reject/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'reject_invoice'])->name('reject-invoice');

Route::get('/get/buy/form', [App\Http\Controllers\front\BuyController::class, 'get_buy_form'])->name('get.buy.form');
Route::post('/submit/buy/form', [App\Http\Controllers\front\BuyController::class, 'submit_buy_form'])->name('submit.buy.form');
Route::get('/razor/init/request', [App\Http\Controllers\front\BuyController::class, 'razorpay_initiate_request'])->name('razorpay.request');
Route::post('/razor/complete', [App\Http\Controllers\front\BuyController::class, 'razor_payment_complete'])->name('razor.payments.complete');
Route::post('/', [App\Http\Controllers\LandingController::class, 'payment_response_page'])->name('razor.payments.finish');


Route::middleware([SetViewVariable::class, 'auth'])->group(function () {

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::any('payu-money-payment', [App\Http\Controllers\PayuMoneyController::class, 'redirectToPayU'])->name('redirectToPayU');
    Route::any('payu-money-payment-cancel', [App\Http\Controllers\PayuMoneyController::class, 'paymentCancel'])->name('payumoney-cancel');
    Route::any('payu-money-payment-success', [App\Http\Controllers\PayuMoneyController::class, 'paymentSuccess'])->name('payumoney-success');

    Route::any('ccavenue', [App\Http\Controllers\PaymentController::class, 'ccavenue_form'])->name('ccavenue');
    Route::any('/ccavenue/response', [App\Http\Controllers\PaymentController::class, 'ccavenue_response'])->name('ccavenue-response');

    Route::post('/notification/check', [App\Http\Controllers\HomeController::class, 'show_notification_toast'])->name('notification.check');
    Route::post('/notification/list', [App\Http\Controllers\HomeController::class, 'notification_list'])->name('common.notification.list');
    Route::post('/notification/read', [App\Http\Controllers\HomeController::class, 'make_noti_read'])->name('common.notification.read');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::post('/dashboard-save-position', [App\Http\Controllers\HomeController::class, 'save_dashboard_position'])->name('save.dashboard_position');

    Route::post('/get/closeweek/data', [App\Http\Controllers\HomeController::class, 'close_week'])->name('get-closeweek-data');
    Route::post('/get/planned/data', [App\Http\Controllers\HomeController::class, 'ajax_get_done_planed'])->name('get-planned-data');
    Route::get('/deals-dashboard', [App\Http\Controllers\HomeController::class, 'dealsIndex'])->name('deals-dashboard');
    Route::get('/deals-pipelines', [App\Http\Controllers\HomeController::class, 'dealsPipeline'])->name('deals-pipeline');

    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::get('/account/change-password', [App\Http\Controllers\AccountController::class, 'index'])->name('change_password');
    Route::post('/account/settings/tab', [App\Http\Controllers\AccountController::class, 'get_settings_tab'])->name('settings.tab');
    Route::post('/account/save', [App\Http\Controllers\AccountController::class, 'save'])->name('account.save');
    Route::post('/company/save', [App\Http\Controllers\AccountController::class, 'company_save'])->name('account.company.save');
    Route::post('/payment/save', [App\Http\Controllers\AccountController::class, 'payment_save'])->name('account.payment.save');

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

    Route::get('pdf/{id}', [App\Http\Controllers\DealsController::class, 'generatePDF'])->name('pdf');

    //Activities
    Route::prefix('activities')->group(function () {
        Route::get('/', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\ActivityController::class, 'add_edit'])->name('activities.add')->middleware('checkAccess:is_edit');
        Route::post('/edit', [App\Http\Controllers\ActivityController::class, 'add_edit_modal'])->name('activities.edit')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\ActivityController::class, 'save'])->name('activities.save');
        Route::post('/view', [App\Http\Controllers\ActivityController::class, 'view'])->name('activities.view')->middleware('checkAccess:is_view');
        Route::post('/list', [App\Http\Controllers\ActivityController::class, 'ajax_list'])->name('activities.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\ActivityController::class, 'delete'])->name('activities.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\ActivityController::class, 'change_status'])->name('activities.status');
        Route::post('/mark_as_done', [App\Http\Controllers\ActivityController::class, 'mark_as_done'])->name('activities.mark_as_done')->middleware('checkAccess:is_edit');
        Route::post('/comment/save', [App\Http\Controllers\ActivityController::class, 'comment_save'])->name('activities.comment.save');
        Route::post('/comment/list', [App\Http\Controllers\ActivityController::class, 'comment_list'])->name('activities.comment.list');
        Route::post('/comment/modal', [App\Http\Controllers\ActivityController::class, 'comment_modal'])->name('activities.comment.modal');
    });
    //notes route
    Route::prefix('notes')->group(function () {
        Route::get('/', [App\Http\Controllers\NoteController::class, 'index'])->name('notes')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\NoteController::class, 'add_edit'])->name('notes.add')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\NoteController::class, 'save'])->name('notes.save');
        Route::post('/view', [App\Http\Controllers\NoteController::class, 'view'])->name('notes.view')->middleware('checkAccess:is_view');
        Route::post('/list', [App\Http\Controllers\NoteController::class, 'ajax_list'])->name('notes.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\NoteController::class, 'delete'])->name('notes.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\NoteController::class, 'change_status'])->name('notes.status');
    });
    //pages route
    Route::prefix('pages')->group(function () {
        Route::get('/', [App\Http\Controllers\CmsController::class, 'index'])->name('pages')->middleware('checkAccess:is_view');
        Route::get('/add/{id?}', [App\Http\Controllers\CmsController::class, 'add'])->name('pages.add')->middleware('checkAccess:is_edit');
        Route::get('/edit/{id?}', [App\Http\Controllers\CmsController::class, 'edit'])->name('pages.edit')->middleware('checkAccess:is_edit');
        Route::post('/save/{type?}', [App\Http\Controllers\CmsController::class, 'save'])->name('pages.save');
        Route::post('/update/{id?}', [App\Http\Controllers\CmsController::class, 'update'])->name('pages.update');
        Route::post('/list', [App\Http\Controllers\CmsController::class, 'ajax_list'])->name('pages.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\CmsController::class, 'delete'])->name('pages.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\CmsController::class, 'change_status'])->name('pages.status')->middleware('checkAccess:is_edit');
    });
    //Automation route
    Route::prefix('automation')->group(function () {
        Route::get('/', [App\Http\Controllers\AutomationController::class, 'index'])->name('automation')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\AutomationController::class, 'add_edit'])->name('automation.add')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\AutomationController::class, 'save'])->name('automation.save');
        Route::post('/list', [App\Http\Controllers\AutomationController::class, 'ajax_list'])->name('automation.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\AutomationController::class, 'delete'])->name('automation.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\AutomationController::class, 'change_status'])->name('automation.status')->middleware('checkAccess:is_edit');
        Route::post('/view', [App\Http\Controllers\AutomationController::class, 'view'])->name('automation.view')->middleware('checkAccess:is_view');
    });
    //products route
    Route::prefix('products')->group(function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\ProductController::class, 'add_edit'])->name('products.add')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\ProductController::class, 'save'])->name('products.save');
        Route::post('/view', [App\Http\Controllers\ProductController::class, 'view'])->name('products.view')->middleware('checkAccess:is_view');
        Route::post('/list', [App\Http\Controllers\ProductController::class, 'ajax_list'])->name('products.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.delete')->middleware('checkAccess:is_delete');;
        Route::post('/status', [App\Http\Controllers\ProductController::class, 'change_status'])->name('products.status');
    });
    //leads route
    Route::prefix('leads')->group(function () {
        Route::get('/', [App\Http\Controllers\LeadController::class, 'index'])->name('leads')->middleware('checkAccess:is_view');
        Route::get('/view/{id}', [App\Http\Controllers\LeadController::class, 'view'])->name('leads.view')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\LeadController::class, 'add_edit'])->name('leads.add')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\LeadController::class, 'save'])->name('leads.save');
        Route::post('/activity/save', [App\Http\Controllers\LeadController::class, 'activity_save'])->name('leads.save-activity');
        Route::post('/notes/save', [App\Http\Controllers\LeadController::class, 'notes_save'])->name('leads.save-notes');
        Route::post('/list', [App\Http\Controllers\LeadController::class, 'ajax_list'])->name('leads.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\LeadController::class, 'delete'])->name('leads.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\LeadController::class, 'change_status'])->name('leads.status');
        Route::post('/refresh/timeline', [App\Http\Controllers\LeadController::class, 'refresh_timeline'])->name('leads.refresh-timeline');
        Route::post('/activity/delete', [App\Http\Controllers\LeadController::class, 'delete_activity'])->name('leads.activity-delete');
        Route::post('/mark_as_done', [App\Http\Controllers\LeadController::class, 'mark_as_done'])->name('leads.mark_as_done');
        Route::post('/get_tab', [App\Http\Controllers\LeadController::class, 'get_tab'])->name('leads.get_tab');
    });
    //deals route 
    Route::prefix('deals')->group(function () {
        Route::get('/', [App\Http\Controllers\DealsController::class, 'index'])->name('deals')->middleware('checkAccess:is_view');
        Route::get('/view/{id}', [App\Http\Controllers\DealsController::class, 'view'])->name('deals.view')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\DealsController::class, 'add_edit'])->name('deals.add')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\DealsController::class, 'save'])->name('deals.save');
        Route::post('/delete', [App\Http\Controllers\DealsController::class, 'delete'])->name('deals.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\DealsController::class, 'change_status'])->name('deals.status');
        Route::post('/list', [App\Http\Controllers\DealsController::class, 'ajax_list'])->name('deals.list');
        Route::post('/product/list', [App\Http\Controllers\DealsController::class, 'product_list'])->name('deals.product-list');
        Route::post('/activity/save', [App\Http\Controllers\DealsController::class, 'activity_save'])->name('deals.save-activity');
        Route::post('/notes/save', [App\Http\Controllers\DealsController::class, 'notes_save'])->name('deals.save-notes');
        Route::post('/refresh/timeline', [App\Http\Controllers\DealsController::class, 'refresh_timeline'])->name('deals.refresh-timeline');
        Route::post('/activity/delete', [App\Http\Controllers\DealsController::class, 'delete_activity'])->name('deals.activity-delete');
        Route::post('/mark_as_done', [App\Http\Controllers\DealsController::class, 'mark_as_done'])->name('deals.mark_as_done');
        Route::post('/files/save', [App\Http\Controllers\DealsController::class, 'files_save'])->name('deals.save-files');
        Route::post('/stage/complete', [App\Http\Controllers\DealsController::class, 'make_stage_completed'])->name('deals.make_stage_completed');
        Route::post('/stage/complete/pipeline', [App\Http\Controllers\DealsController::class, 'make_stage_completed_pipline'])->name('deals.make_stage_completed_pipline');
        Route::post('/finalize', [App\Http\Controllers\DealsController::class, 'deal_finalize'])->name('deals.finalize')->middleware('checkAccess:is_edit');
        Route::post('/insert/invoice', [App\Http\Controllers\DealsController::class, 'insert_invoice'])->name('deals.save-invoice');
        Route::post('/get/items', [App\Http\Controllers\DealsController::class, 'invoice_product_list'])->name('invoices.add_items');
        Route::post('/invoice/unlink', [App\Http\Controllers\DealsController::class, 'unlink_invoice'])->name('deals.unlink');
        Route::post('/invoice/submit', [App\Http\Controllers\DealsController::class, 'submit_for_approve'])->name('deals.submit-approve');
        Route::post('/get_tab', [App\Http\Controllers\DealsController::class, 'get_tab'])->name('deals.get_tab');
        Route::post('/get_product_tax', [App\Http\Controllers\DealsController::class, 'get_product_tax'])->name('deals.get_product_tax');
        Route::post('/get_deal_common_sub_list', [App\Http\Controllers\DealsController::class, 'get_deal_common_sub_list'])->name('deals.common.list');
        Route::post('/change/pdf', [App\Http\Controllers\DealsController::class, 'change_pdf_template'])->name('invoice.pdf.change');
    });

    //Invoice route
    Route::prefix('invoices')->group(function () {
        Route::get('/', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices')->middleware('checkAccess:is_view');
        Route::get('/invoices-template', [App\Http\Controllers\InvoiceController::class, 'template_index'])->name('invoices-templates')->middleware('checkAccess:is_view');
        Route::post('/invoices-download', [App\Http\Controllers\InvoiceController::class, 'template_download'])->name('invoices-templates')->middleware('checkAccess:is_view');
        Route::post('/list', [App\Http\Controllers\InvoiceController::class, 'ajax_list'])->name('invoices.list')->middleware('checkAccess:is_view');
        Route::post('/view', [App\Http\Controllers\InvoiceController::class, 'view'])->name('invoices.view')->middleware('checkAccess:is_view'); //set on modal
    });

    //Payment route
    Route::prefix('payments')->group(function () {
        Route::get('/', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments');
        Route::post('/list', [App\Http\Controllers\PaymentController::class, 'ajax_list'])->name('payments.list');
        Route::get('/add', [App\Http\Controllers\PaymentController::class, 'add'])->name('payments.add');
        Route::post('/save', [App\Http\Controllers\PaymentController::class, 'save'])->name('payments.save');
        Route::post('/autocomplete_customer', [App\Http\Controllers\PaymentController::class, 'autocomplete_customer'])->name('payments.autocomplete.customer');
        Route::post('/customer/deal', [App\Http\Controllers\PaymentController::class, 'customer_deal_info'])->name('payments.customer.deal_info');
        Route::post('/customer/deal/amount', [App\Http\Controllers\PaymentController::class, 'customer_deal_amount'])->name('payments.customer.deal_amount');
        Route::post('/view', [App\Http\Controllers\PaymentController::class, 'view'])->name('payments.view');
        Route::post('/delete', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payments.delete');
        Route::post('/get/page', [App\Http\Controllers\PaymentController::class, 'get_page'])->name('payments.get_page');
        Route::get('/initiate-request/{payment_gateway}', [App\Http\Controllers\PaymentController::class, 'initiate_request'])->name('payments.initiate');
        Route::post('/initiate-request/payment', [App\Http\Controllers\PaymentController::class, 'payment_initiate_request'])->name('payments.initiate.request');
        Route::post('/payment/complete', [App\Http\Controllers\PaymentController::class, 'payment_complete'])->name('payments.complete');
    });

    //tasks route
    Route::prefix('tasks')->group(function () {
        Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\TaskController::class, 'add_edit'])->name('tasks.add')->middleware('checkAccess:is_edit');
        Route::post('/save', [App\Http\Controllers\TaskController::class, 'save'])->name('tasks.save');
        Route::post('/view', [App\Http\Controllers\TaskController::class, 'view'])->name('tasks.view')->middleware('checkAccess:is_view');
        Route::post('/list', [App\Http\Controllers\TaskController::class, 'ajax_list'])->name('tasks.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\TaskController::class, 'delete'])->name('tasks.delete');
        Route::post('/status', [App\Http\Controllers\TaskController::class, 'change_status'])->name('tasks.status');
        Route::post('/complete/status', [App\Http\Controllers\TaskController::class, 'complete_task'])->name('tasks.complete');
    });

    Route::prefix('organizations')->group(function () {
        Route::get('/', [App\Http\Controllers\OrganizationController::class, 'index'])->name('organizations')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\OrganizationController::class, 'add_edit'])->name('organizations.add')->middleware('checkAccess:is_edit');
        Route::post('/view', [App\Http\Controllers\OrganizationController::class, 'view'])->name('organizations.view')->middleware('checkAccess:is_view');
        Route::post('/save', [App\Http\Controllers\OrganizationController::class, 'save'])->name('organizations.save');
        Route::post('/list', [App\Http\Controllers\OrganizationController::class, 'ajax_list'])->name('organizations.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\OrganizationController::class, 'delete'])->name('organizations.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\OrganizationController::class, 'change_status'])->name('organizations.status');
    });

    Route::prefix('leadstage')->group(function () {
        Route::get('/', [App\Http\Controllers\LeadTypeController::class, 'index'])->name('leadstage')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\LeadTypeController::class, 'add_edit'])->name('leadstage.add')->middleware('checkAccess:is_edit');
        Route::post('/view', [App\Http\Controllers\LeadTypeController::class, 'view'])->name('leadstage.view')->middleware('checkAccess:is_view');
        Route::post('/save', [App\Http\Controllers\LeadTypeController::class, 'save'])->name('leadstage.save');
        Route::post('/list', [App\Http\Controllers\LeadTypeController::class, 'ajax_list'])->name('leadstage.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\LeadTypeController::class, 'delete'])->name('leadstage.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\LeadTypeController::class, 'change_status'])->name('leadstage.status');
    });

    Route::prefix('leadsource')->group(function () {
        Route::any('', [App\Http\Controllers\LeadSourceController::class, 'index'])->name('leadsource')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\LeadSourceController::class, 'add_edit'])->name('leadsource.add')->middleware('checkAccess:is_edit');
        Route::post('/view', [App\Http\Controllers\LeadSourceController::class, 'view'])->name('leadsource.view')->middleware('checkAccess:is_view');
        Route::post('/save', [App\Http\Controllers\LeadSourceController::class, 'save'])->name('leadsource.save');
        Route::post('/list', [App\Http\Controllers\LeadSourceController::class, 'ajax_list'])->name('leadsource.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\LeadSourceController::class, 'delete'])->name('leadsource.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\LeadSourceController::class, 'change_status'])->name('leadsource.status');
    });
    Route::prefix('dealstages')->group(function () {
        Route::get('/', [App\Http\Controllers\DealStageController::class, 'index'])->name('dealstages')->middleware('checkAccess:is_view');
        Route::post('/add', [App\Http\Controllers\DealStageController::class, 'add_edit'])->name('dealstages.add')->middleware('checkAccess:is_edit');
        Route::post('/view', [App\Http\Controllers\DealStageController::class, 'view'])->name('dealstages.view')->middleware('checkAccess:is_view');
        Route::post('/save', [App\Http\Controllers\DealStageController::class, 'save'])->name('dealstages.save');
        Route::post('/list', [App\Http\Controllers\DealStageController::class, 'ajax_list'])->name('dealstages.list')->middleware('checkAccess:is_view');
        Route::post('/delete', [App\Http\Controllers\DealStageController::class, 'delete'])->name('dealstages.delete')->middleware('checkAccess:is_delete');
        Route::post('/status', [App\Http\Controllers\DealStageController::class, 'change_status'])->name('dealstages.status');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        //activity status route
        Route::get('/activity-status', [App\Http\Controllers\ActivityStatusController::class, 'index'])->name('activity-status');
        Route::post('/activity-status/add', [App\Http\Controllers\ActivityStatusController::class, 'add_edit'])->name('activity-status.add');
        Route::post('/activity-status/save', [App\Http\Controllers\ActivityStatusController::class, 'save'])->name('activity-status.save');
        Route::post('/activity-status/list', [App\Http\Controllers\ActivityStatusController::class, 'ajax_list'])->name('activity-status.list');
        Route::post('/activity-status/delete', [App\Http\Controllers\ActivityStatusController::class, 'delete'])->name('activity-status.delete');
        Route::post('/activity-status/status', [App\Http\Controllers\ActivityStatusController::class, 'change_status'])->name('activity-status.status');

        Route::get('/task-status', [App\Http\Controllers\ActivityStatusController::class, 'index'])->name('task-status');
        Route::post('/task-status/add', [App\Http\Controllers\ActivityStatusController::class, 'add_edit'])->name('task-status.add');
        Route::post('/task-status/save', [App\Http\Controllers\ActivityStatusController::class, 'save'])->name('task-status.save');
        Route::post('/task-status/list', [App\Http\Controllers\ActivityStatusController::class, 'ajax_list'])->name('task-status.list');
        Route::post('/task-status/delete', [App\Http\Controllers\ActivityStatusController::class, 'delete'])->name('task-status.delete');
        Route::post('/task-status/status', [App\Http\Controllers\ActivityStatusController::class, 'change_status'])->name('task-status.status');

        //users route
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::post('/users/add', [App\Http\Controllers\UserController::class, 'add_edit'])->name('users.add');
        Route::post('/users/view', [App\Http\Controllers\UserController::class, 'view'])->name('users.view');
        Route::post('/users/save', [App\Http\Controllers\UserController::class, 'save'])->name('users.save');
        Route::post('/users/list', [App\Http\Controllers\UserController::class, 'ajax_list'])->name('users.list');
        Route::post('/users/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
        Route::post('/users/status', [App\Http\Controllers\UserController::class, 'change_status'])->name('users.status');
        //roles route
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
        Route::post('/roles/add', [App\Http\Controllers\RoleController::class, 'add_edit'])->name('roles.add');
        Route::post('/roles/view', [App\Http\Controllers\RoleController::class, 'view'])->name('roles.view');
        Route::post('/roles/save', [App\Http\Controllers\RoleController::class, 'save'])->name('roles.save');
        Route::post('/roles/list', [App\Http\Controllers\RoleController::class, 'ajax_list'])->name('roles.list');
        Route::post('/roles/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
        Route::post('/roles/status', [App\Http\Controllers\RoleController::class, 'change_status'])->name('roles.status');
        //permission route
        Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions');
        Route::post('/permissions/view', [App\Http\Controllers\PermissionController::class, 'view'])->name('permissions.view');
        Route::post('/permissions/add', [App\Http\Controllers\PermissionController::class, 'add_edit'])->name('permissions.add');
        Route::post('/permissions/save', [App\Http\Controllers\PermissionController::class, 'save'])->name('permissions.save');
        Route::post('/permissions/list', [App\Http\Controllers\PermissionController::class, 'ajax_list'])->name('permissions.list');
        Route::post('/permissions/delete', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');
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

        Route::get('/country', [App\Http\Controllers\CountryController::class, 'index'])->name('country');
        Route::post('/country/add', [App\Http\Controllers\CountryController::class, 'add_edit'])->name('country.add');
        Route::post('/country/view', [App\Http\Controllers\CountryController::class, 'view'])->name('country.view');
        Route::post('/country/save', [App\Http\Controllers\CountryController::class, 'save'])->name('country.save');
        Route::post('/country/list', [App\Http\Controllers\CountryController::class, 'ajax_list'])->name('country.list');
        Route::post('/country/delete', [App\Http\Controllers\CountryController::class, 'delete'])->name('country.delete');
        Route::post('/country/status', [App\Http\Controllers\CountryController::class, 'change_status'])->name('country.status');

        Route::get('/teams', [App\Http\Controllers\TeamController::class, 'index'])->name('teams');
        Route::post('/teams/add', [App\Http\Controllers\TeamController::class, 'add_edit'])->name('teams.add');
        Route::post('/teams/view', [App\Http\Controllers\TeamController::class, 'view'])->name('teams.view');
        Route::post('/teams/save', [App\Http\Controllers\TeamController::class, 'save'])->name('teams.save');
        Route::post('/teams/list', [App\Http\Controllers\TeamController::class, 'ajax_list'])->name('teams.list');
        Route::post('/teams/delete', [App\Http\Controllers\TeamController::class, 'delete'])->name('teams.delete');
        Route::post('/teams/status', [App\Http\Controllers\TeamController::class, 'change_status'])->name('teams.status');

        Route::get('/tax', [App\Http\Controllers\TaxController::class, 'index'])->name('tax');
        Route::post('/tax/add', [App\Http\Controllers\TaxController::class, 'add_edit'])->name('tax.add');
        Route::post('/tax/view', [App\Http\Controllers\TaxController::class, 'view'])->name('tax.view');
        Route::post('/tax/save', [App\Http\Controllers\TaxController::class, 'save'])->name('tax.save');
        Route::post('/tax/list', [App\Http\Controllers\TaxController::class, 'ajax_list'])->name('tax.list');
        Route::post('/tax/delete', [App\Http\Controllers\TaxController::class, 'delete'])->name('tax.delete');
        Route::post('/tax/status', [App\Http\Controllers\TaxController::class, 'change_status'])->name('tax.status');
    });

    Route::get('invoice', function () {
        return view('invoice');
    });

    Route::get('mail-message', function () {
        return view('mail-message');
    });

    // Email Template Routes
    Route::prefix('email-template')->group(function () {
        Route::get('/', [App\Http\Controllers\EmailTemplateController::class, 'index'])->name('email.index');
        Route::get('/create', [App\Http\Controllers\EmailTemplateController::class, 'create'])->name('create.email_template')->middleware('checkLimit:template');
        Route::post('/create', [App\Http\Controllers\EmailTemplateController::class, 'store'])->name('store.email_template');
        Route::get('/edit/{id?}', [App\Http\Controllers\EmailTemplateController::class, 'edit'])->name('edit.email_template');
        Route::post('/edit/{id?}', [App\Http\Controllers\EmailTemplateController::class, 'update'])->name('update.email_template');
        Route::post('/delete/{id?}', [App\Http\Controllers\EmailTemplateController::class, 'delete'])->name('delete.email_template');
    });

    Route::prefix('bulk_import')->group(function () {
        Route::get('/', [App\Http\Controllers\BulkPdfImport::class, 'index'])->name('bulk_import.index');
        Route::post('/create', [App\Http\Controllers\BulkPdfImport::class, 'store'])->name('store.bulk_import');
        Route::get('/edit/{id?}', [App\Http\Controllers\BulkPdfImport::class, 'edit'])->name('edit.bulk_import');
        Route::post('/edit/{id?}', [App\Http\Controllers\BulkPdfImport::class, 'update'])->name('update.bulk_import');
        Route::post('/delete/{id?}', [App\Http\Controllers\BulkPdfImport::class, 'delete'])->name('delete.bulk_import');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.sale');
        Route::get('/started', [App\Http\Controllers\ReportController::class, 'deal_started'])->name('reports.started');
        Route::post('/started/list', [App\Http\Controllers\ReportController::class, 'ajax_deal_started_list'])->name('reports.started.list');
        Route::post('/started/download', [App\Http\Controllers\ReportController::class, 'deal_started_download'])->name('reports.started.download');
        Route::post('/started/pdf/download', [App\Http\Controllers\ReportController::class, 'deal_started_pdf_download'])->name('reports.started_pdf.download');
        Route::get('/sales', [App\Http\Controllers\ReportController::class, 'sales'])->name('reports.sales');
        Route::post('/sales/list', [App\Http\Controllers\ReportController::class, 'ajax_deal_sales_list'])->name('reports.sales.list');
        Route::post('/sales/download', [App\Http\Controllers\ReportController::class, 'deal_sales_download'])->name('reports.sales.download');
        Route::post('/sales/pdf/download', [App\Http\Controllers\ReportController::class, 'deal_sales_pdf_download'])->name('reports.sales_pdf.download');
        Route::get('/planned', [App\Http\Controllers\ReportController::class, 'planned_done'])->name('reports.planned');
        Route::get('/forecast', [App\Http\Controllers\ReportController::class, 'forecast'])->name('reports.forecast');
        Route::post('/forecast/list', [App\Http\Controllers\ReportController::class, 'ajax_forecast_list'])->name('reports.forecast.list');
        Route::post('/forecast/download', [App\Http\Controllers\ReportController::class, 'forecast_download'])->name('reports.forecast.download');
        Route::post('/forecast/pdf/download', [App\Http\Controllers\ReportController::class, 'forecast_pdf_download'])->name('reports.forecast_pdf.download');
        Route::post('/planned/list', [App\Http\Controllers\ReportController::class, 'ajax_planned_list'])->name('reports.planned.list');
        Route::post('/planned/download', [App\Http\Controllers\ReportController::class, 'planned_download'])->name('reports.planned.download');
        Route::post('/planned/pdf/download', [App\Http\Controllers\ReportController::class, 'planned_pdf_download'])->name('reports.planned_pdf.download');
    });

    Route::prefix('announcement')->group(function () {
        Route::get('/', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcement.index');
        Route::get('/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('create.announcement');
        Route::post('/create', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('store.announcement');
        Route::get('/edit/{id?}', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('edit.announcement');
        Route::post('/edit/{id?}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('update.announcement');
        Route::post('/delete/{id?}', [App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('destroy.announcement');
    });

    Route::prefix('activity_log')->group(function () {
        Route::get('/', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity_log.index');
        Route::post('/log', [App\Http\Controllers\ActivityLogController::class, 'ajax_list'])->name('activity_log.log');
        Route::post('/view', [App\Http\Controllers\ActivityLogController::class, 'view'])->name('activity_log.view');
    });

    Route::get('backup', [App\Http\Controllers\DataBaseBackupController::class, 'index'])->name('db-backup.index');
    Route::post('create-backup', [App\Http\Controllers\DataBaseBackupController::class, 'backup'])->name('create.backup');
    Route::delete('backup/{id}', [App\Http\Controllers\DataBaseBackupController::class, 'delete'])->name('delete.database-backup');
    Route::post('backup/{id}', [App\Http\Controllers\DataBaseBackupController::class, 'download'])->name('download.database-backup');
});
