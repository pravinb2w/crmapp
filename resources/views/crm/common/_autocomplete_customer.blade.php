<div>
    <ul>
        @if(isset($list) && count( $list )> 0)
        
            @foreach ($list as $item)
                <li onclick="return cus_auto_operand('{{ $item->id }}', '{{ $item->type }}')">
                    {{ $item->first_name .' ' .$item->email}} 
                </li>
            @endforeach
        @else
            <li > {{ $query }} &emsp;<span class="badge bg-primary"><a href="#" class="text-white" onclick="return cus_auto_operand('', '{{ $query }}')">Add New</a></span></li>
        @endif
       
    </ul>
</div>