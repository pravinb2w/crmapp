

<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<div class="row">
    <div class="col-sm-6 card">
        <div class="card-body">
            <div>
                <label for="">Subscription</label>
                {{ $info->company->subscription->subscription->subscription_name ?? '' }}
            </div>
            <div>
                <label for="">
                    Total Amount
                </label>
                {{ $info->company->subscription->total_amount ?? '' }}
            </div>
        </div>
    </div>
    <div class="col-sm-6 card">
        <div class="card-body">
            <div>
                <label for="">
                    Start Date
                </label>
                {{ $info->company->subscription->startAt ?? '' }}
            </div>
            <div>
                <label for="">
                    End Date
                </label>
                {{ $info->company->subscription->endAt ?? '' }}
            </div>
        </div>
    </div>
    
    <div>
        <table class="table">
            <tr>
                <th>No of Clients </th>
                <td> {{ $info->company->subscription->subscription->no_of_clients ?? '' }}</td>
                <th>Bulk Import</th>
                <td>{{ $info->company->subscription->subscription->bulk_import ?? '' }}</td>
            </tr>
            <tr>
                <th>No of Employees </th>
                <td> {{ $info->company->subscription->subscription->no_of_employees ?? '' }}</td>
                <th>Database Backup</th>
                <td>{{ $info->company->subscription->subscription->database_backup ?? '' }}</td>
            </tr>
            <tr>
                <th>No of Leads </th>
                <td> {{ $info->company->subscription->subscription->no_of_leads ?? '' }}</td>
                <th>Work Automation</th>
                <td>{{ $info->company->subscription->subscription->work_automation ?? '' }}</td>
            </tr>
            <tr>
                <th>No of Deals </th>
                <td> {{ $info->company->subscription->subscription->no_of_deals ?? '' }}</td>
                <th>Telegram Bot</th>
                <td>{{ $info->company->subscription->subscription->telegram_bot ?? '' }}</td>
            </tr>
            <tr>
                <th>No of Pages </th>
                <td> {{ $info->company->subscription->subscription->no_of_pages ?? '' }}</td>
                <th>Sms Integration</th>
                <td>{{ $info->company->subscription->subscription->sms_integration ?? '' }}</td>
            </tr>
            <tr>
                <th>No of Email Templates </th>
                <td> {{ $info->company->subscription->subscription->no_of_email_templates ?? '' }}</td>
                <th>Payment Gateway</th>
                <td>{{ $info->company->subscription->subscription->payment_gateway ?? '' }}</td>
            </tr>
            <tr>
                <th> Bussiness Whatsapp</th>
                <td> {{ $info->company->subscription->subscription->business_whatsapp ?? '' }}</td>
                <th></th>
                <td></td>
            </tr>
        </table>
    </div>

</div>