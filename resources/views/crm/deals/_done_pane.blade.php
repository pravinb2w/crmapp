<div class="timeline-show mb-3 text-center">
    <style>
        .notepane {
            background: rgb(255, 252, 220) !important;
        }
    </style>
    <h5 class="badge badge-success-lighten"> Done </h5>
</div> 
<div class="text-center">
    @php
        $done_type = $done_type ?? 'all';
    @endphp
    <label for="" class="@if( isset( $done_type ) && $done_type == 'all' ) badge badge-info-lighten @endif px-2">
        <a href="javascript:;" onclick="refresh_deal_timeline('done','{{ $deal_id }}', 'all');">All</a> 
    </label>
    <label for="" class="@if( isset( $done_type ) && $done_type == 'activity' ) badge badge-info-lighten @endif px-2">
        <a href="javascript:;" onclick="refresh_deal_timeline('done','{{ $deal_id }}', 'activity');">Activities</a> 
    </label>
    <label for="" class="@if( isset( $done_type ) && $done_type == 'notes' ) badge badge-info-lighten @endif px-2">
        <a href="javascript:;" onclick="refresh_deal_timeline('done','{{ $deal_id }}', 'notes');">Notes</a> 
    </label>
    <label for="" class="@if( isset( $done_type ) && $done_type == 'files' ) badge badge-info-lighten @endif px-2">
        <a href="javascript:;" onclick="refresh_deal_timeline('done','{{ $deal_id }}', 'files');">Files</a> 
    </label>
    {{-- <label for="" class="@if( isset( $done_type ) && $done_type == 'logs' ) badge badge-info-lighten @endif px-2">
        <a href="javascript:;" onclick="refresh_deal_timeline('done','{{ $deal_id }}', 'logs');">Log</a> 
    </label> --}}
</div>
<div class="border-start py-0 p-3" id="done-pane">
    
    @if( (isset($info->done_activity ) && !empty($info->done_activity) ) || (isset($info->notes) && !empty($info->notes ) ) )
        @php
            $list = [];
            if( isset( $done_type ) && ( $done_type == 'all' || $done_type == 'activity') ) {
                if( isset( $info->done_activity ) && !empty($info->done_activity ) ){
                    foreach ($info->done_activity as $item){
                        $tmp['activity_type'] = $item->activity_type;
                        $tmp['subject'] = $item->subject;
                        $tmp['deal_id'] = $info->id;
                        $tmp['id'] = $item->id;
                        $tmp['done_at'] = $item->done_at;
                        $tmp['done_by'] = $item->doneBy;
                        $tmp['added'] = $item->added;
                        $list[] = $tmp;
                    }
                }
            }
            if( isset( $done_type ) && ( $done_type == 'all' || $done_type == 'notes') ) {

                if( isset( $info->notes ) && !empty($info->notes ) ){
                    foreach ($info->notes as $ionotes){
                        $tmp['activity_type'] = '';
                        $tmp['subject'] = $ionotes->notes;
                        $tmp['deal_id'] = $info->id;
                        $tmp['id'] = $ionotes->id;
                        $tmp['done_at'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ionotes->updated_at)->format('Y-m-d H:i:s');
                        $tmp['done_by'] = $ionotes->updatedBy;
                        $tmp['added'] = $ionotes->added;
                        $list[] = $tmp;
                    }
                }
            }
            if( isset( $done_type ) && ( $done_type == 'all' || $done_type == 'files') ) {
                if( isset( $info->files ) && !empty($info->files ) ){
                    foreach ($info->files as $iofiles){
                        $tmp['activity_type'] = 'files';
                        $tmp['subject'] = 'Document Created';
                        $tmp['deal_id'] = $info->id;
                        $tmp['id'] = $iofiles->id;
                        $tmp['done_at'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $iofiles->created_at)->format('Y-m-d H:i:s');
                        $tmp['added'] = $iofiles->added;
                        $tmp['document'] = $iofiles->document;
                        $list[] = $tmp;
                    }
                }
            }

            if( isset( $done_type ) && $done_type == 'all' ) {
                $tmp['activity_type'] = 'Deal';
                $tmp['subject'] = 'Deal Created';
                $tmp['deal_id'] = $info->id;
                $tmp['id'] = '';
                $tmp['done_at'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $info->created_at)->format('Y-m-d H:i:s');
                $tmp['added'] = $info->added;
                $list[] = $tmp;
            }
            foreach ($list as $key => $part) {
                $sort[$key] = strtotime($part['done_at']);
            }
            if( !empty($list)) {
                array_multisort($sort, SORT_DESC, $list);
            }
        @endphp
        @forelse ($list as $litem)
       
            <div class="right">
                <div class="timeline-lg-item timeline-item-right">
                    <div class="timeline-desk">
                        <div class="timeline-box @if(empty($litem['activity_type'])) notepane @endif">
                            <span class="arrow"></span>
                            <h4 class="mt-0 mb-1 font-16 w-85">
                                <span class="timeline-icon">
                                <i class="mdi mdi-adjust"></i> 
                                @if(!empty($litem['activity_type'])) {{ strtoupper($litem['activity_type']) }}  - @endif {{ $litem['subject'] }}</span>
                                @if( isset( $litem['document'] ) && !empty($litem['document'])) 
                                <small class="ml-3">
                                    <a href="{{ asset('storage/'.$litem['document']) }}" target="_blank"> View Files </a>
                                </small>
                                @endif
                            </h4>
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"  onclick="change_activity_status('{{ $info->id }}','{{ $litem['id'] }}', 'done')">Delete</a>
                                </div>
                            </div>
                            <div class="text-danger">
                                <small> {{ date('d M Y H:i A', strtotime($litem['done_at'] ) ); }}
                                </small>
                                @if( isset($litem['done_by'])&& !empty($litem['done_by']))
                                    <span class="badge badge-success-lighten"> CompletedBy : {{ $litem['doneBy']->name ?? '' }}</span>
                                @else
                                    <span class="badge badge-success-lighten"> AddedBy : {{ $litem['added']->name ?? '' }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            @empty
            <div class="text-center">
                <span>No data</span>
            </div>
            @endforelse
    @endif
</div>