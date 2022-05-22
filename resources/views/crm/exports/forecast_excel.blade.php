<table>
    <thead>
    <tr>
        <th>Deal </th>
        <th>Invoice</th>
        <th>Customer</th>
        <th>Due Date</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
        @if( isset($fore) && !empty($fore))
            @foreach ($fore as $inv)
            <tr>
                <td> {{ $inv->deal->deal_title ?? '' }}  </td>
                <td> {{ $inv->invoice_no ?? '' }}</td>
                <td>{{ $inv->customer->first_name ?? '' }}</td>
                <td> {{ $inv->due_date ?? '' }}</td>
                <td> {{ $inv->total ?? '' }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>