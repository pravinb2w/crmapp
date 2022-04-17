<div>
    <ul>
        @if(isset($list) && count( $list )> 0)
        
            @foreach ($list as $item)
                <li onclick="return get_payment_customer_typeahead('{{ $item->id }}', '{{ $item->first_name }}')">
                    {{ $item->first_name .' ' .$item->email}} 
                </li>
            @endforeach
        @else
            <li > No Customer found !!!</li>
        @endif
       
    </ul>
</div>