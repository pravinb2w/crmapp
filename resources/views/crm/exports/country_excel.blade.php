<table>
    <thead>
        <tr>
            <th>Country Name</th>
            <th>Dial Code</th>
            <th>Country Code</th>
            <th>ISO</th>
            <th>Currency</th>
            <th>Description</th>
            <th>Status</th>
            <th>Added By</th>
            <th> Created At </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $act)
                <tr>
                    <td>{{ $act->country_name }}</td>
                    <td>{{ $act->dial_code }}</td>
                    <td>{{ $act->country_code }}</td>
                    <td>{{ $act->iso }}</td>
                    <td>{{ $act->currency }}</td>
                    <td>{{ $act->description }}</td>
                    <td>{{ $act->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $act->added->name ?? '' }}</td>
                    <td> {{ $act->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
