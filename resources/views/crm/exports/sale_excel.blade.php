<table>
    <thead>
    <tr>
        <th>Payment Date</th>
        <th>Payment Mode</th>
        <th>Customer</th>
        <th>Deal</th>
        <th>Order Id</th>
        <th>Currency</th>
        <th>Amount</th>
        <th>Payment Method</th>
        <th>Cheque No</th>
        <th>Cheque Date</th>
        <th>Reference No</th>
        <th>Payment Status</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
        @if( isset($deals) && !empty($deals))
            @foreach ($deals as $pay)
            <tr>
                <td> {{ date('d-m-Y', strtotime($pay->created_at)) }}  </td>
                <td> {{ ucwords($pay->payment_mode) }}</td>
                <td>{{ $pay->customer->first_name ?? ''; }}</td>
                <td> {{ '' }}</td>
                <td> {{ $pay->order_id ?? '' }}</td>
                <td>{{ $pay->currency ?? '' }}</td>
                <td>{{ $pay->amount ?? '' }}</td>
                <td>{{ ucfirst($pay->payment_method) }}</td>
                <td>{{ $pay->cheque_no ?? '' }}</td>
                <td>{{ $pay->cheque_date ?? '' }}</td>
                <td>{{ $pay->reference_no ?? '' }}</td>
                <td>{{ ucfirst($pay->payment_status) }}</td>
                <td>{{ $pay->description ?? '' }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>