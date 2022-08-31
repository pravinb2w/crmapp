<table>
    <thead>
        <tr>
            <th>Document Name</th>
            <th>Added By</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $document_types)
                <tr>
                    <td>{{ $document_types->document_name }}</td>
                    <td>{{ $document_types->added->name ?? '' }}</td>
                    <td>{{ $document_types->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $document_types->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
