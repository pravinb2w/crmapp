<table>
    <thead>
        <tr>
            <th>Team Name</th>
            <th>Team Limit</th>
            <th>Description</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $task)
                <tr>
                    <td>{{ $task->team_name }}</td>
                    <td>{{ $task->team_limit ?? '' }}</td>
                    <td>{{ $task->description ?? '' }}</td>
                    <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $task->added->name ?? '' }}</td>
                    <td> {{ $task->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
