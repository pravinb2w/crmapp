<div class="timeline-show mb-3 text-center">
    <h5 class="badge badge-warning-lighten"> Initiated </h5>
</div> 
<div class="border-start py-0 p-3" id="initiated-pane">
    @if( isset($info->planned_activity ) && !empty($info->planned_activity))
    <input type="hidden" id="planned_count" value="{{ count($info->planned_activity) }}">
        @forelse ($info->planned_activity as $item)
            <div class="right">
                <div class="timeline-lg-item timeline-item-right">
                    <div class="timeline-desk">
                        <div class="timeline-box">
                            <span class="arrow"></span>
                            <h4 class="mt-0 mb-1 font-16 w-85"><span class="timeline-icon">
                                <i class="mdi mdi-adjust"></i> {{ strtoupper($item->activity_type) }}  - {{ $item->subject }}</span></h4>
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:;"  onclick="edit_activity('planned','{{ $item->id }}', '','{{ $info->id }}')">Edit</a>
                                    <a class="dropdown-item" href="#" onclick="mark_as_done('planned','{{ $item->id }}', '{{ $info->id }}')">Mark as Done</a>
                                    <a class="dropdown-item" href="#" onclick="change_activity_status('{{ $info->id }}','{{ $item->id }}', 'planned')">
                                        
                                        Delete</a>
                                </div>
                            </div>
                            <div class="text-danger"><small> 
                                {{ date('d M Y H:i A', strtotime($item->created_at ) ); }}</small>
                                @if( isset($info->updatedBy)&& !empty($info->updatedBy))
                                    <span class="badge badge-success-lighten"> UpdatedBy : {{ $info->updatedBy->name ?? '' }}</span>
                                @else
                                    <span class="badge badge-success-lighten"> AddedBy : {{ $info->added->name ?? '' }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        @empty
        <div class="text-center">
            <span>No data.</span>
        </div>
        @endforelse
    @endif
</div>
