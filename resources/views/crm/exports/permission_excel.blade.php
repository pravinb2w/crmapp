<table>
    <thead>
        <tr>
            <th>Role</th>
            <th>Permissions</th>
            <th>Status</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $task)
                <tr>
                    <td>{{ $task->role->role }}</td>
                    <td>
                        @if (isset($task->permission) && !empty($task->permission))
                            <table>
                                <tr>
                                    <th>Menu</th>
                                    <th>Is View</th>
                                    <th>Is Edit</th>
                                    <th>Is Delete</th>
                                    <th>Is Assign</th>
                                    <th>Is Export</th>
                                    <th>Is Filter</th>
                                </tr>
                                @foreach ($task->permission as $item)
                                    <tr>
                                        <td>{{ $item->menu }}</td>
                                        <td>{{ $item->is_view }}</td>
                                        <td>{{ $item->is_edit }}</td>
                                        <td>{{ $item->is_delete }}</td>
                                        <td>{{ $item->is_assign }}</td>
                                        <td>{{ $item->is_assign }}</td>
                                        <td>{{ $item->is_filter }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </td>

                    <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $task->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
