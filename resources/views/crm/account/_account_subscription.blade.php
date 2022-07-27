

<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<div class="row">
    <div class="col-sm-6 card">
        <div class="card-body">
            <div>
                <label class="col-3 col-form-label">Subscription</label>
                {{ $info->company->subscription->subscription->subscription_name ?? 'N/A' }}
            </div>
            <div>
                <label class="col-3 col-form-label">
                    Total Amount
                </label>
                {{ $info->company->subscription->total_amount ?? '0' }}
            </div>
        </div>
    </div>
    <div class="col-sm-6 card">
        <div class="card-body">
            <div>
                <label class="col-3 col-form-label">
                    Start Date
                </label>
                {{ $info->company->subscription->startAt ?? 'N/A' }}
            </div>
            <div>
                <label class="col-3 col-form-label">
                    End Date
                </label>
                {{ $info->company->subscription->endAt ?? 'N/A' }}
            </div>
        </div>
    </div>
    
    <div>
        <table class="table">
            <tr>
                <th>No of Clients </th>
                <td> {{ $info->company->subscription->subscription->no_of_clients ?? '0' }}</td>
                <th>Bulk Import</th>
                <td>{{ $info->company->subscription->subscription->bulk_import ?? '0' }}</td>
            </tr>
            <tr>
                <th>No of Employees </th>
                <td> {{ $info->company->subscription->subscription->no_of_employees ?? '0' }}</td>
                <th>Database Backup</th>
                <td>{{ $info->company->subscription->subscription->database_backup ?? '0' }}</td>
            </tr>
            <tr>
                <th>No of Leads </th>
                <td> {{ $info->company->subscription->subscription->no_of_leads ?? '0' }}</td>
                <th>Work Automation</th>
                <td>{{ $info->company->subscription->subscription->work_automation ?? '0' }}</td>
            </tr>
            <tr>
                <th>No of Deals </th>
                <td> {{ $info->company->subscription->subscription->no_of_deals ?? '0' }}</td>
                <th>Telegram Bot</th>
                <td>{{ $info->company->subscription->subscription->telegram_bot ?? '0' }}</td>
            </tr>
            <tr>
                <th>No of Pages </th>
                <td> {{ $info->company->subscription->subscription->no_of_pages ?? '0' }}</td>
                <th>Sms Integration</th>
                <td>{{ $info->company->subscription->subscription->sms_integration ?? '0' }}</td>
            </tr>
            <tr>
                <th>No of Email Templates </th>
                <td> {{ $info->company->subscription->subscription->no_of_email_templates ?? '0' }}</td>
                <th>Payment Gateway</th>
                <td>{{ $info->company->subscription->subscription->payment_gateway ?? '0' }}</td>
            </tr>
            <tr>
                <th> Bussiness Whatsapp</th>
                <td> {{ $info->company->subscription->subscription->business_whatsapp ?? '0' }}</td>
                <th></th>
                <td></td>
            </tr>
        </table>
    </div>

</div>