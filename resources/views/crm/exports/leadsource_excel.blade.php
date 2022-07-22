<table>
    <thead>
        <tr>
            <th>Source Name</th>
            <th>Description</th>
            <th>Added By</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $lead)
                <tr>
                    <td>{{ $lead->source }}</td>
                    <td>{{ $lead->description ?? '' }}</td>
                    <td>{{ $lead->added->name ?? '' }}</td>
                    <td>{{ $lead->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $lead->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
