<style>
    .new-item {
        display: block;
    width: 100%;
    padding: 0.375rem 1.5rem;
    padding: 10px 20px;
    clear: both;
    font-weight: 400;
    color: #6c757d;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    }
    .new-item:hover {
        background:#fafbfe;
    }

    .notify-item .notify-details {
        margin-bottom: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .notify-item .user-msg {
        white-space: normal;
        line-height: 16px;
    }
    .unread{
        background: aliceblue;
    }
    </style>
<div class="p-2" >
    <!-- Settings -->
    @php
        // $list = 'tsetet';
        
    @endphp
    @if(isset( $list))
    @forelse ($list as $item)
        <a href="@if( superadmin() && isset($item->url) && !empty($item->url) ) {{ $item->url }} @else javascript:void(0); @endif" class="new-item notify-item @if($item->is_read == 0) unread @endif" @if( isset( $role_id ) && !empty($role_id) ) onclick="return make_read('{{ $item->id }}')" @endif>
            <p class="notify-details">{{ $item->title }}</p>
            <p class="text-muted mb-0 user-msg">
                <small>{{ $item->message }}</small>
            </p>
        </a>
    @empty
        <a href="javascript:void(0);" class="new-item notify-item">
            <p class="notify-details">Data Not Found</p>
            <p class="text-muted mb-0 user-msg">
                <small>No records found</small>
            </p>
        </a>
    @endforelse
    @endif

    
</div> <!-- end padding-->
<script>
    var counts = '{{ $count ?? 0 }}';
    counts = parseInt(counts);
    if( counts == 0 ) {
        $('#noti-has').hide();
    } else {
        $('#noti-has').show();
    }
</script>