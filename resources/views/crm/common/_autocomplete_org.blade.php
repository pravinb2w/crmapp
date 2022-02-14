<div>
    <ul>
        @if(isset($list) && count( $list )> 0)
        
            @foreach ($list as $item)
                <li onclick="return org_auto_operand('{{ $item->id }}')">
                    {{ $item->name }} 
                </li>
            @endforeach
        @else
            <li onclick> {{ $query }} &emsp;<span class="badge bg-primary"><a href="#" class="text-white" onclick="return org_auto_operand('', '{{ $query }}')">Add New</a></span></li>
        @endif
       
    </ul>
</div>