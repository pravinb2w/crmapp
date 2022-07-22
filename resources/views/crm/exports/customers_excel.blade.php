<table>
    <thead>
        <tr>
            <th>First Name </th>
            <th>Last Name</th>
            <th>DOB</th>
            <th>Email</th>
            <th> Mobile No </th>
            <th> Address </th>
            <th>Status</th>
            <th>Company</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $cus)
                <tr>
                    <td>{{ $cus->first_name }}</td>
                    <td>{{ $cus->last_name ?? '' }}</td>
                    <td>{{ $cus->dob ?? '' }}</td>
                    <td>{{ $cus->email ?? '' }}</td>
                    <td>{{ $cus->mobile_no ?? '' }}</td>
                    <td>{{ $cus->address ?? '' }}</td>
                    <td>{{ $cus->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $cus->company->name ?? '' }}</td>
                    <td> {{ $cus->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
