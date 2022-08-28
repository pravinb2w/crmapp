<table>
    <thead>
        <tr>
            <th>Customer Email</th>
            <th>Subscribe status</th>
            <th>Created At</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $newsletter)
                <tr>
                    <td>{{ $newsletter->email }}</td>
                    <td>{{ $newsletter->subscribe == 1 ? 'Subscribed' :'Unsubscribed' }}</td>
                    <td> {{ $newsletter->created_at }}</td>
                    <td>{{ $newsletter->status == 1 ? 'Active' : ($newsletter->status == 2 ? 'Done' : 'Inactive') }}</td>

                </tr>
            @endforeach
        @endif
    </tbody>
</table>
