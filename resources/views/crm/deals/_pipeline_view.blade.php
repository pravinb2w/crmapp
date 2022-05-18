@php
            // print_r( $pipeline );
@endphp
@if( isset( $stage ) && !empty($stage))
<div class="btn-group align-item-center p-1 w-100" id="tooltip-container2">
    @foreach ($stage as $item)
    @php
        $class = '';
        $onclick = '';
        $days = null;
        $key_arr = array_search($item->id, array_column($pipeline, 'stage_id'));
     
        if( isset( $pipeline[$key_arr]['stage_id'] ) && $item->id == $pipeline[$key_arr]['stage_id'] ) {
            
            if( isset( $pipeline[$key_arr]['completed_at'] ) && !empty($pipeline[$key_arr]['completed_at'] ) ) {
                $date1 = date('Y-m-d', strtotime($pipeline[$key_arr]['completed_at']));
            } else {
                $date1 = date('Y-m-d');
            }
            $date2 = date('Y-m-d', strtotime($pipeline[$key_arr]['created_at']));
            
            $date1=date_create($date1);
            $date2=date_create($date2);
            $diff=date_diff($date1,$date2);
            $days =$diff->format("%a days");
        }
        
        if(  in_array($item->id, $completed_stage) ) {
            $class = 'active';
            
        } else {
            if( ( Auth::id() == $info->assigned_to || $info->assigned_to == null ) ) {
                $onclick = 'onclick=make_stage_completed('.$item->id.','.$id.')';

            }
        }
    @endphp
        <span {{ $onclick }} class="pipeline-btn py-0 btn text-white btn-light {{ $class }}"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $item->stages }}">
            <small>{{ $days ?? '0 Days' }}</small>
        </span>
    @endforeach
</div>
@endif
<span>
    {{ $info->current_stage->stages ?? '' }}
</span>
<span class="float-right">
    {{ date( 'd M, Y', strtotime($info->current_stage->created_at) ) }}
</span>