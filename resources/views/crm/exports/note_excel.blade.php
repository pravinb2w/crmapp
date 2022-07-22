<table>
    <thead>
        <tr>
            <th>Notes</th>
            <th>Lead</th>
            <th>Deal</th>
            <th>Customer</th>
            <th>User</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $task)
                <tr>
                    <td>{{ $task->notes }}</td>
                    <td>{{ $task->lead->lead_subject ?? '' }}</td>
                    <td>{{ $task->deal->deal_title ?? '' }}</td>
                    <td>{{ $task->customer->first_name ?? '' }}</td>
                    <td>{{ $task->user->name ?? '' }}</td>
                    <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $task->added->name ?? '' }}</td>
                    <td> {{ $task->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
