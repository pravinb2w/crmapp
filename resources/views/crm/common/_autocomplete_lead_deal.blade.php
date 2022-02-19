<div>
    <ul>
        @if(isset($list) && count( $list )> 0)
        
            @foreach ($list as $item)
                <li onclick="return leade_deal_set({{ $item['id'] }},'{{ $item['type'] }}')">
                    {{ $item['name']}} 
                </li>
            @endforeach
        @endif
       
    </ul>
</div>