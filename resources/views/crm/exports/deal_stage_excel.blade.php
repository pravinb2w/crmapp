<table>
    <thead>
        <tr>
            <th>Stage Name</th>
            <th>Description</th>
            <th>Order</th>
            <th>Added By</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $stages)
                <tr>
                    <td>{{ $stages->stages }}</td>
                    <td>{{ $stages->description ?? '' }}</td>
                    <td>{{ $stages->order_by ?? '' }}</td>
                    <td>{{ $stages->added->name ?? '' }}</td>
                    <td>{{ $stages->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $stages->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
