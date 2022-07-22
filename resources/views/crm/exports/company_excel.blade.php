<table>
    <thead>
        <tr>
            <th>Company Name</th>
            <th>Email</th>
            <th> Mobile No </th>
            <th> Address </th>
            <th>Fax</th>
            <th> Description </th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $org)
                <tr>
                    <td>{{ $org->name }}</td>
                    <td>{{ $org->email ?? '' }}</td>
                    <td>{{ $org->mobile_no ?? '' }}</td>
                    <td>{{ $org->address ?? '' }}</td>
                    <td>{{ $org->fax ?? '' }}</td>
                    <td>{{ $org->description ?? '' }}</td>
                    <td>{{ $org->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $org->added->name ?? '' }}</td>
                    <td> {{ $org->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
