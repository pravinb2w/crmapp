<table>
    <thead>
        <tr>
            <th>Role</th>
            <th>Description</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $roles)
                <tr>
                    <td>{{ $roles->role }}</td>
                    <td>{{ $roles->description ?? '' }}</td>
                    <td>{{ $roles->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $roles->added->name ?? '' }}</td>
                    <td> {{ $roles->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
