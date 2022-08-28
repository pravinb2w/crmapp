<table>
    <thead>
        <tr>
            <th>Invoice No</th>
            <th>Order No</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Customer Mobile no</th>
            <th>Invoice Address</th>
            <th>Remarks</th>
            <th>Currency</th>
            <th>Total Price</th>
            <th>Paid At</th>
            <th>Paid Amount</th>
            <th>Created At</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $invoice_info)
                <tr>
                    <td>{{ $invoice_info->invoice_no }}</td>
                    <td>{{ $invoice_info->order_no ?? '' }}</td>
                    <td>{{ $invoice_info->issue_date ?? '' }}</td>
                    <td>{{ $invoice_info->due_date ?? '' }}</td>
                    <td>{{ $invoice_info->customer->first_name ?? '' }}</td>
                    <td>{{ $invoice_info->customer->email ?? '' }}</td>
                    <td>{{ ($invoice_info->customer->dial_code ?? '').$invoice_info->customer->mobile_no ?? '' }}</td>
                    <td>{{ $invoice_info->address ?? '' }}</td>
                    <td>{{ $invoice_info->remarks ?? '' }}</td>
                    <td>{{ $invoice_info->currency ?? '' }}</td>
                    <td>{{ $invoice_info->total ?? '' }}</td>
                    <td>{{ $invoice_info->paid_at ?? '' }}</td>
                    <td>{{ $invoice_info->paid_amount ?? '' }}</td>
                    <td> {{ $invoice_info->created_at }}</td>
                    <td>{{ $invoice_info->status == 1 ? 'Active' : ($invoice_info->status == 2 ? 'Done' : 'Inactive') }}</td>

                </tr>
            @endforeach
        @endif
    </tbody>
</table>
