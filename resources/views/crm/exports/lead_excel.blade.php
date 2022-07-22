<table>
    <thead>
        <tr>
            <th>Lead Title</th>
            <th>Lead Description</th>
            <th>Lead Value</th>
            <th>Lead Currency</th>
            <th>Lead Type</th>
            <th>Lead Source</th>
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
            @foreach ($details as $lead)
                <tr>
                    <td>{{ $lead->lead_subject }}</td>
                    <td>{{ $lead->lead_description ?? '' }}</td>
                    <td>{{ $lead->lead_value ?? '' }}</td>
                    <td>{{ $lead->lead_currency ?? '' }}</td>
                    <td>{{ $lead->leadType->type ?? '' }}</td>
                    <td>{{ $lead->leadSource->source ?? '' }}</td>
                    <td>{{ $lead->customer->first_name ?? '' }}</td>
                    <td>{{ $lead->assignedTo->name ?? '' }}</td>
                    <td>{{ $lead->assignedBy->name ?? '' }}</td>
                    <td>{{ $lead->added->name ?? '' }}</td>
                    <td>{{ $lead->status == 1 ? 'Active' : ($lead->status == 2 ? 'Done' : 'Inactive') }}</td>
                    <td> {{ $lead->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
