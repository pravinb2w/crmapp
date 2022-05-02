<table>
    <thead>
    <tr>
        <th>Deal Title</th>
        <th>Deal Value</th>
        <th>Current Stage</th>
        <th>Customer</th>
        <th>Assigned To</th>
        <th>Started At</th>
        <th>Status</th>
        <th>Expected Completed Date</th>
    </tr>
    </thead>
    <tbody>
        @if( isset($deals) && !empty($deals))
            @foreach ($deals as $item)
            <tr>
                <td> {{ $item->deal_title }}  </td>
                <td> {{ $item->deal_value; }}</td>
                <td>{{ $item->current_stage->stages }}</td>
                <td> {{ $item->customer->first_name ?? '' }}</td>
                <td> {{ $item->assignedTo->name ?? '' }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ ($item->status == 1 ) ? 'Active' : 'Inactive' }}</td>
                <td>{{ date('d-m-Y', strtotime($item->expected_completed_date)) }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>