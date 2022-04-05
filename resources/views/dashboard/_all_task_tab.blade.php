<div class="card-body task-pane">
    <div class="dropdown float-end">
        <select name="" id="" class="bar-select mb-2" style="top: 0;">
            <option value="">All</option>
            <option value="">Overdue</option>
            <option value="">Recent</option>
            <option value="">Overdue</option>
            <option value="">Cancelled</option>

        </select>
        <span class="dragula-handle float-end"></span>
    </div>
    <h4 class="header-title mb-3">All Task</h4>

    @if( isset( $my_task ) && !empty($my_task))
        @foreach ($my_task as $item)
        @php
            $customer = '';
            $description = '';
            $label = '<span class="badge badge-warning-lighten float-end"> '.ucwords($item['task_type']).'</span>';
            if( $item['status'] == '2' ) {
                $label = '<span class="badge badge-success-lighten float-end"> Won '.ucwords($item['task_type']).'</span>';
            }
            if( isset( $item['customer'] ) && !empty($item['customer']) ) {
                $customer = '<span class="badge badge-secondary-lighten"> '.ucwords($item['customer']->first_name).'</span>';
            }
        @endphp
        <div class="d-flex align-items-start mt-2">
            <div class="w-100 overflow-hidden">
                {!! $label !!}
                <h5 class="mt-0 mb-0">{{ $item['task_name'] ?? '' }} {!! $customer !!}</h5>
                <span class="font-13">{{ $item['description'] ?? '' }}</span>
            </div>
        </div>
        @endforeach
    @else
    <div class="d-flex align-items-start">
        <div class="w-100 overflow-hidden">
            No task available
        </div>
    </div>
    @endif
        
</div>