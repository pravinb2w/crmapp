<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>Role</th>
            <th>Lead Limit</th>
            <th>Deal Limit</th>
            <th>Status</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->last_name ?? '' }}</td>
                    <td>{{ $task->email ?? '' }}</td>
                    <td>{{ $task->mobile_no ?? '' }}</td>
                    <td>{{ $task->role->role ?? '' }}</td>
                    <td>{{ $task->lead_limit ?? '' }}</td>
                    <td>{{ $task->deal_limit ?? '' }}</td>
                    <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $task->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
