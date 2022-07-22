<table>
    <thead>
        <tr>
            <th>Payment Mode</th>
            <th>Customer</th>
            <th>Deal</th>
            <th>Invoice</th>
            <th>Order Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No</th>
            <th>Currency </th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Cheque No</th>
            <th>Cheque Date</th>
            <th>Reference No</th>
            <th>UPI Id</th>
            <th>Card No</th>
            <th>Payment Response</th>
            <th>Payment Status</th>
            <th>Description</th>
            <th>Generated Links</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $stages)
                <tr>
                    <td>{{ $stages->payment_mode }}</td>
                    <td>{{ $stages->customer->first_name ?? '' }}</td>
                    <td>{{ $stages->deal->deal_title ?? '' }}</td>
                    <td>{{ $stages->invoice->invoice_no ?? '' }}</td>
                    <td>{{ $stages->order_id }}</td>
                    <td>{{ $stages->name }}</td>
                    <td>{{ $stages->email }}</td>
                    <td>{{ $stages->contact_no }}</td>
                    <td>{{ $stages->currency }}</td>
                    <td>{{ $stages->amount }}</td>
                    <td>{{ $stages->payment_method }}</td>
                    <td>{{ $stages->cheque_no }}</td>
                    <td>{{ $stages->cheque_date }}</td>
                    <td>{{ $stages->reference_no }}</td>
                    <td>{{ $stages->upi_id }}</td>
                    <td>{{ $stages->card_no }}</td>
                    <td>{{ $stages->payment_response }}</td>
                    <td>{{ $stages->payment_status }}</td>
                    <td>{{ $stages->description }}</td>
                    <td>{{ $stages->generated_links }}</td>
                    <td>{{ $stages->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $stages->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
