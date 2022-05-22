<table>
    <thead>
    <tr>
        <th>Title </th>
        <th>Type</th>
        <th>Customer</th>
        <th>User</th>
        <th>Lead / Deal </th>
        <th>Assigned Date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        @if( isset($list) && !empty($list))
            @foreach ($list as $inv)
            <tr>
                <td> {{ $inv['title'] }}  </td>
                <td> {{ $inv['type'] }}</td>
                <td>{{ $inv['customer'] }}</td>
                <td> {{ $inv['user']; }}</td>
                <td> {{ $inv['lead_deal'] }}</td>
                <td> {{  $inv['assigned_date'] }}</td>
                <td> {{  $inv['status'] }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>