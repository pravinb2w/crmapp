<table class="table table-striped">
    @if( isset( $comment_list ) && !empty($comment_list))
        @foreach ( $comment_list as $item )

        <tr>
            <td>{{ $item->comments }}</td>
            <td class="text-end">Added By : <span class="text-success">{{ $item->added->name }}</span> &emsp; {{ date('d M Y h:i A', strtotime($item->created_at)) }}</td>
        </tr>
            
        @endforeach
    @endif
</table>