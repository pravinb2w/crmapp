<?php

namespace App\Http\Controllers;

use App\Exports\ActivityExport;
use App\Exports\ActivityStatusExport;
use App\Exports\CompanySubscriptionExport;
use App\Exports\CountryExport;
use App\Exports\CustomerExport;
use App\Exports\DealExport;
use App\Exports\DealStageExport;
use App\Exports\InvoiceExport;
use App\Exports\LeadExport;
use App\Exports\LeadSourceExport;
use App\Exports\LeadStageExport;
use App\Exports\NewsletterExport;
use App\Exports\NotesExport;
use App\Exports\OrganizationExport;
use App\Exports\PageExport;
use App\Exports\PaymentExport;
use App\Exports\PermissionExport;
use App\Exports\ProductExport;
use App\Exports\RoleExport;
use App\Exports\SubscriptionExport;
use App\Exports\TaskExport;
use App\Exports\TeamExport;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $module = $request->module;

        if (isset($module) && strtolower($module) == 'customers') {
            $this->customerExport();
        }
    }

    public function exportCompany(Request $request)
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new OrganizationExport(), 'organization.xlsx');
    }

    public function exportCustomer()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new CustomerExport(), 'customer.xlsx');
    }

    public function exportPage()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new PageExport(), 'pages.xlsx');
    }

    public function exportLead()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new LeadExport(), 'leads.xlsx');
    }

    public function exportLeadSource()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new LeadSourceExport(), 'leadsources.xlsx');
    }

    public function exportLeadStage()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new LeadStageExport(), 'leadstages.xlsx');
    }

    public function exportDeal()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new DealExport(), 'deals.xlsx');
    }

    public function exportDealStage()
    {
        ob_end_clean(); // this
        ob_start();
        return Excel::download(new DealStageExport(), 'dealstages.xlsx');
    }

    public function exportPayment()
    {
        return Excel::download(new PaymentExport(), 'payments.xlsx');
    }

    public function exportProduct()
    {
        return Excel::download(new ProductExport(), 'products.xlsx');
    }

    public function exportActivity()
    {
        return Excel::download(new ActivityExport(), 'activities.xlsx');
    }

    public function exportTask()
    {
        return Excel::download(new TaskExport(), 'tasks.xlsx');
    }
    public function exportNote()
    {
        return Excel::download(new NotesExport(), 'notes.xlsx');
    }

    public function exportUser()
    {
        return Excel::download(new UserExport(), 'users.xlsx');
    }

    public function exportRole()
    {
        return Excel::download(new RoleExport(), 'roles.xlsx');
    }

    public function exportPermission()
    {
        return Excel::download(new PermissionExport(), 'permissions.xlsx');
    }

    public function exportActivityStatus()
    {
        return Excel::download(new ActivityStatusExport('activity'), 'activityStatus.xlsx');
    }

    public function exportTaskStatus()
    {
        return Excel::download(new ActivityStatusExport('task'), 'taskStatus.xlsx');
    }

    public function exportTeam()
    {
        return Excel::download(new TeamExport(), 'teams.xlsx');
    }

    public function exportCountry()
    {
        return Excel::download(new CountryExport(), 'countries.xlsx');
    }

    public function exportSubscriptions()
    {
        return Excel::download(new SubscriptionExport(), 'subscriptions.xlsx');
    }

    public function exportCompanySubscriptions()
    {
        return Excel::download(new CompanySubscriptionExport(), 'companySubscriptions.xlsx');
    }

    public function exportInvoice()
    {
        return Excel::download(new InvoiceExport(), 'Invoice.xlsx');

    }

    public function exportNewsletter()
    {
        return Excel::download(new NewsletterExport(), 'Newsletter.xlsx');
        
    }
}