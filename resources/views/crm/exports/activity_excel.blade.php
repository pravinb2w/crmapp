<table>
    <thead>
        <tr>
            <th>Subject</th>
            <th>Activity Type</th>
            <th>Notes</th>
            <th>Lead</th>
            <th>Deal</th>
            <th>Customer</th>
            <th>User</th>
            <th>Started At</th>
            <th>Due At</th>
            <th>Done At</th>
            <th>Done By</th>
            <th>Available</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $act)
                <tr>
                    <td>{{ $act->subject }}</td>
                    <td>{{ $act->activity_type ?? '' }}</td>
                    <td>{{ $act->notes ?? '' }}</td>
                    <td>{{ $act->lead->lead_subject ?? '' }}</td>
                    <td>{{ $act->deal->deal_title ?? '' }}</td>
                    <td>{{ $act->customer->first_name ?? '' }}</td>
                    <td>{{ $act->user->name ?? '' }}</td>
                    <td>{{ $act->started_at ?? '' }}</td>
                    <td>{{ $act->due_at ?? '' }}</td>
                    <td>{{ $act->done_at ?? '' }}</td>
                    <td>{{ $act->done->name ?? '' }}</td>
                    <td>{{ $act->available ?? '' }}</td>
                    <td>{{ $act->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $act->added->name ?? '' }}</td>
                    <td> {{ $act->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
