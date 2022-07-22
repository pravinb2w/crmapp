<table>
    <thead>
        <tr>
            <th>Subscription Name</th>
            <th>Subscription Period</th>
            <th>No of Clients</th>
            <th>No of Employees</th>
            <th>No of Leads</th>
            <th>No of Deals</th>
            <th>No of Pages</th>
            <th>No of Email Templates</th>
            <th>Bulk Import</th>
            <th>Database Backup</th>
            <th>Work Automation</th>
            <th>Telegram Bot</th>
            <th>Sms Integration</th>
            <th>Payment Gateway</th>
            <th>Business Whatsapp</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $roles)
                <tr>
                    <td>{{ $roles->subscription_name }}</td>
                    <td>{{ $roles->subscription_period ?? '' }}</td>
                    <td>{{ $roles->no_of_clients ?? '' }}</td>
                    <td>{{ $roles->no_of_employees ?? '' }}</td>
                    <td>{{ $roles->no_of_leads ?? '' }}</td>
                    <td>{{ $roles->no_of_deals ?? '' }}</td>
                    <td>{{ $roles->no_of_pages ?? '' }}</td>
                    <td>{{ $roles->no_of_email_templates ?? '' }}</td>
                    <td>{{ $roles->bulk_import ?? '' }}</td>
                    <td>{{ $roles->database_backup ?? '' }}</td>
                    <td>{{ $roles->work_automation ?? '' }}</td>
                    <td>{{ $roles->telegram_bot ?? '' }}</td>
                    <td>{{ $roles->sms_integration ?? '' }}</td>
                    <td>{{ $roles->payment_gateway ?? '' }}</td>
                    <td>{{ $roles->business_whatsapp ?? '' }}</td>
                    <td>{{ $roles->amount ?? '' }}</td>
                    <td>{{ $roles->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $roles->added->name ?? '' }}</td>
                    <td> {{ $roles->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
