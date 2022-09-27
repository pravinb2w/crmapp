<table>
    <thead>
        <tr>
            <th>Customer</th>
            <th>Document</th>
            <th>Uploaded At</th>
            <th>Approved At</th>
            <th>Rejected At</th>
            <th>Status</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $cus)
                <tr>
                    <td>{{ $cus->first_name }}</td>
                    <td>{{ $cus->document_name ?? 'N/A' }}</td>
                    <td>{{ date('Y-m-d H:i A', strtotime( $cus->uploadAt ) ) }}</td>
                    <td>{{ $cus->approvedAt ? date('Y-m-d H:i A', strtotime( $cus->approvedAt ) ) : 'n/a' }}</td>
                    <td>{{ $cus->rejectedAt ? date('Y-m-d H:i A', strtotime( $cus->rejectedAt ) ) : 'n/a' }}</td>
                    <td>{{ ucfirst($cus->status) }}</td>
                    <td> {{ $cus->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
