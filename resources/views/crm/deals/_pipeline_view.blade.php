<div class="row  ">
    <div class="col-md-6 mb-3">
       <h3 class="h4 link"><a href="#" class="me-1">{{ $info->deal_title ?? '' }}</a> <i class="mdi mdi-tag"></i></h3>
        <div class="d-flex">
            <div class="btn ps-0"><b class="h4">{{ $info->deal_currency ?? '' }} {{ $info->deal_value ?? '' }}</b></div>
            <div class="btn link">{{ isset($info->deal_products) ? count($info->deal_products) : '0'; }} Products</div>
            <div class="btn"><i class="me-1 dripicons-user"></i> {{ $info->customer->first_name ?? '' }} </div>
            <div class="btn"><i class="me-1 mdi-office-building mdi"></i> {{ $info->customer->company->name ?? '' }}</div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="d-flex align-items-center justify-content-end">
           
            <div class="btn me-2 btn-success">Won</div>
            <div class="btn  me-2 btn-danger">Loss</div>
           
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2">
        @php
            // print_r( $pipeline );
        @endphp
        @if( isset( $stage ) && !empty($stage))
        <div class="btn-group align-item-center p-1 w-100" id="tooltip-container2">
            @foreach ($stage as $item)
            @php
                $class = '';
                $onclick = '';
                $key_arr = array_search($item->id, array_column($pipeline, 'stage_id'));
                
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

                if(  in_array($item->id, $completed_stage) ) {
                    $class = 'active';
                    
                } else {
                    $onclick = 'onclick=make_stage_completed('.$item->id.')';
                }
            @endphp
                <span {{ $onclick }} class="pipeline-btn py-0 btn text-white btn-light {{ $class }}"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $item->stages }}">
                    <small>{{ $days ?? 0 }}</small>
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
    </div>
</div>