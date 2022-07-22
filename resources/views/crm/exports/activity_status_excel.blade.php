<table>
    <thead>
        <tr>
            <th>Status Name</th>
            <th>Order</th>
            <th>Color</th>
            <th>Status</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $act)
                <tr>
                    <td>{{ $act->status_name }}</td>
                    <td>{{ $act->order }}</td>
                    <td>{{ $act->color }}</td>
                    <td>{{ $act->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $act->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
