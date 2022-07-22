<table>
    <thead>
        <tr>
            <th>Subscription</th>
            <th>Company</th>
            <th>Start At</th>
            <th>End At</th>
            <th>Total Amount</th>
            <th>Description</th>
            <th>Status</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $act)
                <tr>
                    <td>{{ $act->subscription->subscription_name ?? '' }}</td>
                    <td>{{ $act->company->name ?? '' }}</td>
                    <td>{{ $act->startAt ?? '' }}</td>
                    <td>{{ $act->endAt ?? '' }}</td>
                    <td>{{ $act->total_amount ?? '' }}</td>
                    <td>{{ $act->description ?? '' }}</td>
                    <td>{{ $act->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $act->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
