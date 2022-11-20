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
//customer login routes
Route::get('/', [App\Http\Controllers\RegisterController::class, 'companyNotFound'])->name('company-not-found')->middleware('checkCompany');

Route::get('/company/notfound', [App\Http\Controllers\RegisterController::class, 'companyNotFound'])->name('company-not-found');
Route::get('/subscription/notfound', [App\Http\Controllers\RegisterController::class, 'subscriptionNotFound'])->name('subscription-not-found');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'registerForm'])->name('register');
Route::get('/code', [App\Http\Controllers\RegisterController::class, 'getCompanyCode'])->name('checkCompanyCode');

Route::get('/register/post', [App\Http\Controllers\RegisterController::class, 'saveRegisterForm'])->name('register.save');

Route::get('/send-mail', [App\Http\Controllers\MailController::class, 'sendMail'])->name('send');

Route::get('/whatsapp', [App\Http\Controllers\MailController::class, 'sendWhatsapp'])->name('wa');
Route::get('/cron-send-mail', [App\Http\Controllers\CronController::class, 'sendMail'])->name('cron.send.mail');

Route::any('payu-money-payment/{order_no}', [App\Http\Controllers\PayuMoneyController::class, 'redirectToPayU'])->name('redirectToPayU');
Route::any('payu-money-payment-cancel', [App\Http\Controllers\PayuMoneyController::class, 'paymentCancel'])->name('payumoney-cancel');
Route::any('payu-money-payment-success', [App\Http\Controllers\PayuMoneyController::class, 'paymentSuccess'])->name('payumoney-success');

Route::middleware([SetViewVariable::class, 'checkCompany'])->prefix('{companyCode}')->group(function () {

    /******** Client login routes */
    Route::get('/login', [App\Http\Controllers\front\Auth\LoginController::class, 'index'])->name('customer-login')->middleware('clientGuest');
    Route::post('/do/login', [App\Http\Controllers\front\Auth\LoginController::class, 'validate_login'])->name('customer-login-check');
    Route::post('/send/otp', [App\Http\Controllers\front\Auth\LoginController::class, 'validate_send_otp'])->name('customer-login-otp');
    Route::post('/verify/otp', [App\Http\Controllers\front\Auth\LoginController::class, 'verity_otp_login'])->name('customer-verity-otp');
    Route::post('/forgetpassword/submit', [App\Http\Controllers\front\Auth\ForgotPasswordController::class, 'send_reset_link'])->name('customer.password.link'); 
    Route::get('/reset-password/{token}', [App\Http\Controllers\front\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('customer.password.get');
    Route::post('/reset-password', [App\Http\Controllers\front\Auth\ForgotPasswordController::class, 'resetPassword'])->name('customer.password.post');

    Route::get('/get/buy/form', [App\Http\Controllers\front\BuyController::class, 'get_buy_form'])->name('get.buy.form');
    Route::get('/get/invoice/buy/form', [App\Http\Controllers\front\BuyController::class, 'getInvoiceBuyForm'])->name('get.invoice.buy.form');
    Route::post('/submit/buy/form', [App\Http\Controllers\front\BuyController::class, 'submit_buy_form'])->name('submit.buy.form');
    Route::post('/submit/buy/invice/form', [App\Http\Controllers\front\BuyController::class, 'submitInvoiceBuyForm'])->name('submit.buy.invoice.form');
    Route::get('/razor/init/request/{order_no}', [App\Http\Controllers\front\BuyController::class, 'razorpay_initiate_request'])->name('razorpay.request');
    Route::post('/razor/complete', [App\Http\Controllers\front\BuyController::class, 'razor_payment_complete'])->name('razor.payments.complete');
    Route::post('/', [App\Http\Controllers\front\LandingController::class, 'payment_response_page'])->name('razor.payments.finish');

    Route::middleware([SetViewVariable::class, 'client'])->group(function () {
        Route::get('/profile/account', [App\Http\Controllers\front\ProfileController::class, 'index'])->name('profile');
        Route::post('/customer/logout', [App\Http\Controllers\front\Auth\LoginController::class, 'logout'])->name('customer-logout');
        Route::post('/customer/info', [App\Http\Controllers\front\ProfileController::class, 'customer_info'])->name('customer-info');
        Route::post('/customer/save', [App\Http\Controllers\front\ProfileController::class, 'save_customer'])->name('customer-save');
        Route::post('/customer/pic/change', [App\Http\Controllers\front\ProfileController::class, 'change_profile_picture'])->name('customer-pic-change');
        Route::post('/customer/pic/remove', [App\Http\Controllers\front\ProfileController::class, 'remove_profile_picture'])->name('customer-pic-remove');
        Route::post('/company/info', [App\Http\Controllers\front\ProfileController::class, 'company_info'])->name('company-info');
        Route::post('/customer/company/save', [App\Http\Controllers\front\ProfileController::class, 'save_company'])->name('customer-company-save');
        Route::get('/profile/settings', [App\Http\Controllers\front\ProfileController::class, 'settings'])->name('profile-settings');
        Route::post('/customer/password/save', [App\Http\Controllers\front\ProfileController::class, 'save_password'])->name('customer-password-save');

        Route::get('/profile/kyc', [App\Http\Controllers\front\KycController::class, 'index'])->name('kyc');
        Route::post('/profile/kyc/submit', [App\Http\Controllers\front\KycController::class, 'kycSubmit'])->name('kyc-submit');

        Route::get('/profile/orders', [App\Http\Controllers\front\OrderController::class, 'index'])->name('orders');
        Route::post('/profile/orders/reject', [App\Http\Controllers\front\OrderController::class, 'rejectInvoice'])->name('orders.reject');
        
    });
    /******    Admin and landing page routes */
    Route::post('/enquiry', [App\Http\Controllers\front\LandingController::class, 'enquiry_save'])->name('enquiry.save');
    Route::post('/subscribe/newsletter', [App\Http\Controllers\front\LandingController::class, 'subscribeNewsletter'])->name('subscribe.newsletter');
    
    Route::get('/devlogin', [App\Http\Controllers\Auth\LoginController::class, 'login_page'])->name('login');
    Route::post('/dev/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::post('/devlogin/submit', [App\Http\Controllers\Auth\LoginController::class, 'check_login'])->name('login.submit');
    Route::get('devlogin/forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('devlogin/forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('devlogin/reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('devlogin/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::get('/{permalink?}', [App\Http\Controllers\front\LandingController::class, 'index'])->name('landing.index');

    Route::middleware(['auth'])->prefix('dev')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard'); 
        Route::post('/dashboard-save-position', [App\Http\Controllers\HomeController::class, 'save_dashboard_position'])->name('save.dashboard_position');
        Route::post('/get/closeweek/data', [App\Http\Controllers\HomeController::class, 'close_week'])->name('get-closeweek-data');
        Route::post('/get/deal_progress/data', [App\Http\Controllers\HomeController::class, 'deal_progress'])->name('get-dealProgress-data');
        Route::post('/get/planned/data', [App\Http\Controllers\HomeController::class, 'ajax_get_done_planed'])->name('get-planned-data');
        Route::get('/deals-dashboard', [App\Http\Controllers\HomeController::class, 'dealsIndex'])->name('deals-dashboard');
        Route::get('/deals-pipelines', [App\Http\Controllers\HomeController::class, 'dealsPipeline'])->name('deals-pipeline');

        Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
        Route::get('/account/change-password', [App\Http\Controllers\AccountController::class, 'index'])->name('change_password');
        Route::post('/account/settings/tab', [App\Http\Controllers\AccountController::class, 'get_settings_tab'])->name('settings.tab');
        Route::post('/account/save', [App\Http\Controllers\AccountController::class, 'save'])->name('account.save');
        Route::post('/company/save', [App\Http\Controllers\AccountController::class, 'company_save'])->name('account.company.save');
        Route::post('/payment/save', [App\Http\Controllers\AccountController::class, 'payment_save'])->name('account.payment.save');

        //pages route
        Route::prefix('pages')->group(function () {
            Route::get('/', [App\Http\Controllers\CmsController::class, 'index'])->name('pages')->middleware('checkAccess:is_view');
            Route::get('/add/{id?}', [App\Http\Controllers\CmsController::class, 'add'])->name('pages.add')->middleware(['checkAccess:is_edit', 'checkLimit:pages']);
            Route::get('/edit/{id?}', [App\Http\Controllers\CmsController::class, 'edit'])->name('pages.edit')->middleware('checkAccess:is_edit');
            Route::post('/save/{type?}', [App\Http\Controllers\CmsController::class, 'save'])->name('pages.save');
            Route::post('/update/{id?}', [App\Http\Controllers\CmsController::class, 'update'])->name('pages.update');
            Route::post('/list', [App\Http\Controllers\CmsController::class, 'ajax_list'])->name('pages.list')->middleware('checkAccess:is_view');
            Route::post('/delete', [App\Http\Controllers\CmsController::class, 'delete'])->name('pages.delete')->middleware('checkAccess:is_delete');
            Route::post('/status', [App\Http\Controllers\CmsController::class, 'change_status'])->name('pages.status')->middleware('checkAccess:is_edit');
        });

        $routeCommonUrlAdmin = array(
                                'organizations' => App\Http\Controllers\OrganizationController::class,
                                'customers' => App\Http\Controllers\CustomerController::class,
                                'document_types' => App\Http\Controllers\DocumentTypeController::class,
                                'leadstage' => App\Http\Controllers\LeadTypeController::class,
                                'leadsource' => App\Http\Controllers\LeadSourceController::class,
                                'notes' => App\Http\Controllers\NoteController::class,
                                'tasks' => App\Http\Controllers\TaskController::class,
                                'products' => App\Http\Controllers\ProductController::class,
                                'dealstages' => App\Http\Controllers\DealStageController::class,
                                'activities' => App\Http\Controllers\ActivityController::class,
                                'automation' => App\Http\Controllers\AutomationController::class,
                            );
        
        foreach ($routeCommonUrlAdmin as $rkey => $rvalue) {
            Route::prefix($rkey)->group(function () use($rkey, $rvalue) {
                Route::get('/', [$rvalue, 'index'])->name($rkey)->middleware('checkAccess:is_view');
                Route::post('/add', [$rvalue, 'add_edit'])->name($rkey.'.add')->middleware(['checkAccess:is_edit', 'checkLimit:'.$rkey]);
                Route::post('/view', [$rvalue, 'view'])->name($rkey.'.view')->middleware('checkAccess:is_view');
                Route::post('/save', [$rvalue, 'save'])->name($rkey.'.save');
                Route::post('/list', [$rvalue, 'ajax_list'])->name($rkey.'.list')->middleware('checkAccess:is_view');
                Route::post('/delete', [$rvalue, 'delete'])->name($rkey.'.delete')->middleware('checkAccess:is_delete');
                Route::post('/status', [$rvalue, 'change_status'])->name($rkey.'.status');
            });
        }

        Route::prefix('newsletter')->group(function () {
            Route::get('/', [App\Http\Controllers\NewsletterController::class, 'index'])->name('newsletter.index');
            Route::post('/list', [App\Http\Controllers\NewsletterController::class, 'ajax_list'])->name('newsletter.list');
            Route::post('/delete', [App\Http\Controllers\NewsletterController::class, 'delete'])->name('newsletter.delete');
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

        Route::prefix('bulk_import')->group(function () {
            Route::get('/', [App\Http\Controllers\BulkPdfImport::class, 'index'])->name('bulk_import.index');
            Route::post('/create', [App\Http\Controllers\BulkPdfImport::class, 'store'])->name('store.bulk_import');
        });

        Route::prefix('announcement')->group(function () {
            Route::get('/', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcement.index');
            Route::post('/list', [App\Http\Controllers\AnnouncementController::class, 'ajax_list'])->name('announcement.list');
            Route::get('/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('create.announcement');
            Route::post('/create', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('store.announcement');
            Route::get('/edit/{id?}', [App\Http\Controllers\AnnouncementController::class, 'edit'])->name('edit.announcement');
            Route::post('/edit/{id?}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('update.announcement');
            Route::post('/delete', [App\Http\Controllers\AnnouncementController::class, 'delete'])->name('destroy.announcement');
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
        //tasks route
        Route::prefix('tasks')->group(function () {
            Route::post('/complete/status', [App\Http\Controllers\TaskController::class, 'complete_task'])->name('tasks.complete');
            Route::post('/comment/save', [App\Http\Controllers\TaskController::class, 'comment_save'])->name('tasks.comment.save');
            Route::post('/comment/list', [App\Http\Controllers\TaskController::class, 'comment_list'])->name('tasks.comment.list');
            Route::post('/comment/modal', [App\Http\Controllers\TaskController::class, 'comment_modal'])->name('tasks.comment.modal');
        });
        //Activities
        Route::prefix('activities')->group(function () {
            Route::post('/edit', [App\Http\Controllers\ActivityController::class, 'add_edit_modal'])->name('activities.edit')->middleware('checkAccess:is_edit');
            Route::post('/mark_as_done', [App\Http\Controllers\ActivityController::class, 'mark_as_done'])->name('activities.mark_as_done')->middleware('checkAccess:is_edit');
            Route::post('/comment/save', [App\Http\Controllers\ActivityController::class, 'comment_save'])->name('activities.comment.save');
            Route::post('/comment/list', [App\Http\Controllers\ActivityController::class, 'comment_list'])->name('activities.comment.list');
            Route::post('/comment/modal', [App\Http\Controllers\ActivityController::class, 'comment_modal'])->name('activities.comment.modal');
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
            Route::post('/add', [App\Http\Controllers\DealsController::class, 'add_edit'])->name('deals.add')->middleware(['checkAccess:is_edit', 'checkLimit:deals']);
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
        Route::get('pdf/{id}', [App\Http\Controllers\DealsController::class, 'generatePDF'])->name('pdf');
        Route::get('/approve/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'approve_invoice'])->name('approve-invoice');
        Route::get('/reject/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'reject_invoice'])->name('reject-invoice');
        Route::get('/download/invoice/{id}', [App\Http\Controllers\InvoiceController::class, 'downloadInvoice'])->name('download-invoice');

        Route::prefix('customers/document')->group(function () {
            Route::get('/approvals', [App\Http\Controllers\DocumentController::class, 'index'])->name('customer_document_approval')->middleware('checkAccess:is_view');
            Route::post('/list', [App\Http\Controllers\DocumentController::class, 'ajax_list'])->name('customer_document_approval.list')->middleware('checkAccess:is_view');
            Route::post('/change/status', [App\Http\Controllers\DocumentController::class, 'changeDocumentStatus'])->name('customer_document_approval.change.status')->middleware('checkAccess:is_edit');
            Route::get('/view/{id}', [App\Http\Controllers\DocumentController::class, 'customerView'])->name('customer_document_approval.customer.view')->middleware('checkAccess:is_view');
        });

        Route::post('/autocomplete_customer', [App\Http\Controllers\CustomerController::class, 'autocomplete_customer'])->name('autocomplete_customer');
        Route::post('/autocomplete_customer_save', [App\Http\Controllers\CustomerController::class, 'autocomplete_customer_save'])->name('autocomplete_customer_save');

        Route::post('/autocomplete_org', [App\Http\Controllers\CustomerController::class, 'autocomplete_organization'])->name('autocomplete_org');
        Route::post('/autocomplete_org_save', [App\Http\Controllers\CustomerController::class, 'autocomplete_organization_save'])->name('autocomplete_org_save');
        Route::post('/autocomplete_lead_deal', [App\Http\Controllers\LeadController::class, 'autocomplete_lead_deal'])->name('autocomplete_lead_deal');
        Route::post('/autocomplete_lead_deal_set', [App\Http\Controllers\LeadController::class, 'autocomplete_lead_deal_set'])->name('autocomplete_lead_deal_set');
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
            Route::post('/payment/resend/url', [App\Http\Controllers\PaymentController::class, 'resend_paylink'])->name('payment.resend.url');
        }); 
        Route::post('/notification/check', [App\Http\Controllers\HomeController::class, 'show_notification_toast'])->name('notification.check');
        Route::post('/notification/list', [App\Http\Controllers\HomeController::class, 'notification_list'])->name('common.notification.list');
        Route::post('/notification/read', [App\Http\Controllers\HomeController::class, 'make_noti_read'])->name('common.notification.read');
        //users route
        Route::prefix('settings')->group(function () {

            $routeSettingUrl = array( 
                                'users' => App\Http\Controllers\UserController::class,
                                'roles' => App\Http\Controllers\RoleController::class,
                                'activity-status' => App\Http\Controllers\ActivityStatusController::class,
                                'task-status' => App\Http\Controllers\ActivityStatusController::class,
                                'country' => App\Http\Controllers\CountryController::class,
                                'subscriptions' => App\Http\Controllers\SubscriptionController::class,
                                'company' => App\Http\Controllers\CompanyController::class,
                                'company-subscriptions' => App\Http\Controllers\CompanySubscriptionController::class,
                            );

            foreach ($routeSettingUrl as $key => $value) {
                Route::prefix($key)->group(function () use($value, $key) {
                    Route::get('/', [$value, 'index'])->name($key);
                    Route::post('/add', [$value, 'add_edit'])->name($key.'.add')->middleware('checkLimit:'.$key);
                    Route::post('/view', [$value, 'view'])->name($key.'.view');
                    Route::post('/save', [$value, 'save'])->name($key.'.save');
                    Route::post('/list', [$value, 'ajax_list'])->name($key.'.list');
                    Route::post('/delete', [$value, 'delete'])->name($key.'.delete');
                    Route::post('/status', [$value, 'change_status'])->name($key.'.status');
                });
            }
            //permission route
            Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions');
            Route::post('/permissions/view', [App\Http\Controllers\PermissionController::class, 'view'])->name('permissions.view');
            Route::post('/permissions/add', [App\Http\Controllers\PermissionController::class, 'add_edit'])->name('permissions.add');
            Route::post('/permissions/save', [App\Http\Controllers\PermissionController::class, 'save'])->name('permissions.save');
            Route::post('/permissions/list', [App\Http\Controllers\PermissionController::class, 'ajax_list'])->name('permissions.list');
            Route::post('/permissions/delete', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');

        });
       
        //export 
        Route::prefix('export')->group(function () {

            Route::any('/user', [App\Http\Controllers\ExportController::class, 'exportUser'])->name('export.users');
            Route::any('/role', [App\Http\Controllers\ExportController::class, 'exportRole'])->name('export.roles');
            Route::any('/permission', [App\Http\Controllers\ExportController::class, 'exportPermission'])->name('export.permission');
            Route::any('/activityStatus', [App\Http\Controllers\ExportController::class, 'exportActivityStatus'])->name('export.activity_status');
            Route::any('/taskStatus', [App\Http\Controllers\ExportController::class, 'exportTaskStatus'])->name('export.task_status');
            Route::any('/country', [App\Http\Controllers\ExportController::class, 'exportCountry'])->name('export.country');
            Route::any('/subscriptions', [App\Http\Controllers\ExportController::class, 'exportSubscriptions'])->name('export.subscriptions');
            Route::any('/organization', [App\Http\Controllers\ExportController::class, 'exportCompany'])->name('export.organization');
            Route::any('/lead/source', [App\Http\Controllers\ExportController::class, 'exportLeadSource'])->name('export.lead_source');
            Route::any('/lead/stage', [App\Http\Controllers\ExportController::class, 'exportLeadStage'])->name('export.lead_stage');
            Route::any('/notes', [App\Http\Controllers\ExportController::class, 'exportNote'])->name('export.notes');
            Route::any('/activity', [App\Http\Controllers\ExportController::class, 'exportActivity'])->name('export.activity');
            Route::any('/task', [App\Http\Controllers\ExportController::class, 'exportTask'])->name('export.tasks');
            Route::any('/products', [App\Http\Controllers\ExportController::class, 'exportProduct'])->name('export.product');
            Route::any('/deals/stage', [App\Http\Controllers\ExportController::class, 'exportDealStage'])->name('export.deal_stage');
            Route::any('/lead', [App\Http\Controllers\ExportController::class, 'exportLead'])->name('export.lead');
            Route::any('/deals', [App\Http\Controllers\ExportController::class, 'exportDeal'])->name('export.deals');
            Route::any('/payments', [App\Http\Controllers\ExportController::class, 'exportPayment'])->name('export.payments');
            Route::any('/invoice', [App\Http\Controllers\ExportController::class, 'exportInvoice'])->name('export.invoice');
            Route::any('/excel', [App\Http\Controllers\ExportController::class, 'exportCustomer'])->name('export.customers');
            Route::any('/pages', [App\Http\Controllers\ExportController::class, 'exportPage'])->name('export.cms_pages');
            Route::any('/newsletter', [App\Http\Controllers\ExportController::class, 'exportNewsletter'])->name('export.news_letter');
            Route::any('/team', [App\Http\Controllers\ExportController::class, 'exportTeam'])->name('export.team');
            Route::any('/company/subscriptions', [App\Http\Controllers\ExportController::class, 'exportCompanySubscriptions'])->name('export.company_subscriptions');
            Route::any('/document/types', [App\Http\Controllers\ExportController::class, 'exportDocumentTypes'])->name('export.document_types');
            Route::any('/customer/document/approval', [App\Http\Controllers\ExportController::class, 'exportCustomerDocumentApproval'])->name('export.customers_document_approval');

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

    });

});

Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);
// Route::get('/{permalink?}', [App\Http\Controllers\front\LandingController::class, 'index'])->name('landing.index');

// Route::any('payu-money-payment', [App\Http\Controllers\PayuMoneyController::class, 'redirectToPayU'])->name('redirectToPayU');

Route::any('/ccavenue/success', [App\Http\Controllers\CcavenueController::class, 'success_payment'])->name('ccavenue-success');

Route::middleware([SetViewVariable::class, 'auth'])->prefix(request()->segment(1).'/dev')->group(function () {

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
Route::middleware([SetViewVariable::class, 'auth'])->prefix('dev')->group(function () {

    Route::any('ccavenue', [App\Http\Controllers\PaymentController::class, 'ccavenue_form'])->name('ccavenue');
    Route::any('/ccavenue/response', [App\Http\Controllers\PaymentController::class, 'ccavenue_response'])->name('ccavenue-response');
    Route::any('/ccavenue/cancel', [App\Http\Controllers\CcavenueController::class, 'cancel_payment'])->name('ccavenue-cancel');
    Route::any('/ccavenue/handler', [App\Http\Controllers\CcavenueController::class, 'response_handler'])->name('ccavenue-handler');
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        Route::get('/pagetype', [App\Http\Controllers\PageTypeController::class, 'index'])->name('pagetype');
        Route::post('/pagetype/add', [App\Http\Controllers\PageTypeController::class, 'add_edit'])->name('pagetype.add');
        Route::post('/pagetype/view', [App\Http\Controllers\PageTypeController::class, 'view'])->name('pagetype.view');
        Route::post('/pagetype/save', [App\Http\Controllers\PageTypeController::class, 'save'])->name('pagetype.save');
        Route::post('/pagetype/list', [App\Http\Controllers\PageTypeController::class, 'ajax_list'])->name('pagetype.list');
        Route::post('/pagetype/delete', [App\Http\Controllers\PageTypeController::class, 'delete'])->name('pagetype.delete');
        Route::post('/pagetype/status', [App\Http\Controllers\PageTypeController::class, 'change_status'])->name('pagetype.status');

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
});