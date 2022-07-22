<table>
    <thead>
        <tr>
            <th>Task Name</th>
            <th>Assigned To</th>
            <th>End Date</th>
            <th>Description</th>
            <th>Task Status</th>
            <th>Done At</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->assigned->name ?? '' }}</td>
                    <td>{{ $task->end_date ?? '' }}</td>
                    <td>{{ $task->description ?? '' }}</td>
                    <td>{{ $task->statusAll->status_name ?? '' }}</td>
                    <td>{{ $task->done_at ?? '' }}</td>
                    <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $task->added->name ?? '' }}</td>
                    <td> {{ $task->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
