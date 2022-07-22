<table>
    <thead>
        <tr>
            <th>Page Title</th>
            <th>Page Logo</th>
            <th>PermaLink</th>
            <th>Page Type</th>
            <th>Mail Us</th>
            <th>Call Us</th>
            <th>Contact Us</th>
            <th>Secondary color</th>
            <th>Ifram Tags</th>
            <th>About Title</th>
            <th>File About</th>
            <th>About Content</th>
            <th>Primary Color</th>
            <th>Is Default Landing Page</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($details) && !empty($details))
            @foreach ($details as $page)
                <tr>
                    <td>{{ $page->page_title }}</td>
                    <td>{{ $page->page_logo ?? '' }}</td>
                    <td>{{ $page->permalink ?? '' }}</td>
                    <td>{{ $page->page_type ?? '' }}</td>
                    <td>{{ $page->mail_us ?? '' }}</td>
                    <td>{{ $page->call_us ?? '' }}</td>
                    <td>{{ $page->contact_us ?? '' }}</td>
                    <td>{{ $page->secondary_color ?? '' }}</td>
                    <td>{{ $page->iframe_tags ?? '' }}</td>
                    <td>{{ $page->about_title ?? '' }}</td>
                    <td>{{ $page->file_about ?? '' }}</td>
                    <td>{{ $page->about_content ?? '' }}</td>
                    <td>{{ $page->primary_color ?? '' }}</td>
                    <td>{{ $page->is_default_landing_page == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ $page->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td> {{ $page->created_at }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
