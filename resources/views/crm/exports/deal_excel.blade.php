<table>
    <thead>
        <tr>
            <th>Deal Title</th>
            <th>Deal Description</th>
            <th>Deal Value</th>
            <th>Deal Currency</th>
            <th>Lead</th>
            <th>Current Stage</th>
            <th>Expected Completed Date</th>
            <th>Product Total</th>
            <th>Customer</th>
            <th>Assigned To</th>
            <th>Assigned By</th>
            <th>Added By</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $deal)
                <tr>
                    <td>{{ $deal->deal_title }}</td>
                    <td>{{ $deal->deal_description ?? '' }}</td>
                    <td>{{ $deal->deal_value ?? '' }}</td>
                    <td>{{ $deal->deal_currency ?? '' }}</td>
                    <td>{{ $deal->lead->lead_subject ?? '' }}</td>
                    <td>{{ $deal->current_stage->stages ?? '' }}</td>
                    <td>{{ $deal->expected_completed_date ?? '' }}</td>
                    <td>{{ $deal->product_total ?? 0 }}</td>
                    <td>{{ $deal->customer->first_name ?? '' }}</td>
                    <td>{{ $deal->assignedTo->name ?? '' }}</td>
                    <td>{{ $deal->assignedBy->name ?? '' }}</td>
                    <td>{{ $deal->added->name ?? '' }}</td>
                    <td>{{ $deal->status == 1 ? 'Active' : ($deal->status == 2 ? 'Done' : 'Inactive') }}</td>
                    <td> {{ $deal->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
