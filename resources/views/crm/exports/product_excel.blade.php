<table>
    <thead>
        <tr>
            <th>Package</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>HSN No</th>
            <th>Cgst</th>
            <th>Sgst</th>
            <th>Igst</th>
            <th>Description</th>
            <th>Price</th>
            <th>Added By</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $pro)
                <tr>
                    <td>{{ $pro->package->subscription_name ?? '' }}</td>
                    <td>{{ $pro->product_name ?? '' }}</td>
                    <td>{{ $pro->product_code ?? '' }}</td>
                    <td>{{ $pro->hsn_no ?? '' }}</td>
                    <td>{{ $pro->cgst ?? '' }}</td>
                    <td>{{ $pro->sgst ?? '' }}</td>
                    <td>{{ $pro->igst ?? '' }}</td>
                    <td>{{ $pro->description ?? '' }}</td>
                    <td>{{ $pro->price ?? '' }}</td>
                    <td>{{ $pro->added->name ?? '' }}</td>
                    <td>{{ $pro->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $pro->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
