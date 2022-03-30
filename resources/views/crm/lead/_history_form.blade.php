<div>
    <table class="table w-100">
       
        @if( (isset($info->all_activity ) && !empty($info->all_activity) ) || (isset($info->notes) && !empty($info->notes ) ) )
        @php
            $list = [];
            if( isset( $info->all_activity ) && !empty($info->all_activity ) ){
                foreach ($info->all_activity as $item){
                    $tmp['activity_type'] = $item->activity_type;
                    $tmp['subject'] = $item->subject;
                    $tmp['lead_id'] = $info->id;
                    $tmp['id'] = $item->id;
                    $tmp['done_at'] = $item->done_at ?? $item->created_at;
                    $tmp['done_by'] = $item->doneBy;
                    $tmp['added'] = $item->added;
                    $list[] = $tmp;
                }

            }
            if( isset( $info->notes ) && !empty($info->notes ) ){
                foreach ($info->notes as $ionotes){
                    $tmp['activity_type'] = 'Notes';
                    $tmp['subject'] = $ionotes->notes;
                    $tmp['lead_id'] = $info->id;
                    $tmp['id'] = $ionotes->id;
                    $tmp['done_at'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ionotes->updated_at)->format('Y-m-d H:i:s');
                    // $tmp['done_by'] = $ionotes->updatedBy;
                    $tmp['added'] = $ionotes->added;
                    $list[] = $tmp;
                }

            }
            foreach ($list as $key => $part) {
                $sort[$key] = strtotime($part['done_at']);
            }
            if( !empty($list)) {
                array_multisort($sort, SORT_DESC, $list);
            }
        @endphp
        @foreach ($list as $litem)
        <tr @if($litem['activity_type'] == 'Notes') style="background: azure" @endif>
            <td class="w-75">
                <div>
                    <div>{{ strtoupper($litem['activity_type']) }}</div>
                    <p> @if($litem['activity_type'] != 'Notes' ) {{ strtoupper($litem['activity_type']) }}  - @endif {{ $litem['subject'] }}</p>
                </div>
                
            </td>
            <td style="position: relative">
                <div>
                    <small> {{ date('d M Y H:i A', strtotime($litem['done_at'] ) ); }}
                    </small>
                </div>
                <div>
                    @if( isset($litem['done_by'])&& !empty($litem['done_by']))
                        <span class="badge badge-success-lighten"> CompletedBy : {{ $litem['done_by']->name ?? '' }}</span>
                    @else
                        <span class="badge badge-success-lighten"> AddedBy : {{ $litem['added']->name ?? '' }}</span>
                    @endif
                </div>
                <div class="dropdown">
                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </button>
                    @if(Auth::user()->hasAccess('leads', 'is_edit') || Auth::user()->hasAccess('leads', 'is_delete'))
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if(Auth::user()->hasAccess('leads', 'is_edit') )
                            @if( $litem['activity_type'] != 'Notes')
                            <a class="dropdown-item" href="javascript:;"  onclick="edit_activity('history','{{ $litem['id'] }}', '{{ $info->id }}')">Edit</a>
                                @if( !$litem['done_by'])
                                    <a class="dropdown-item" href="javascript:;" onclick="mark_as_done('{{ $litem['id'] }}', '{{ $info->id }}')">Mark as Done</a>
                                @endif
                            @endif
                        @endif
                        @if(Auth::user()->hasAccess('leads', 'is_delete') )
                            <a class="dropdown-item" href="#"  onclick="change_activity_status('{{ $info->id ?? '' }}','{{ $litem['id'] ?? '' }}', '{{ $litem['activity_type'] ?? '' }}' )">Delete</a>
                        @endif
                    </div>
                    @endif
                </div> 
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td> No History Found</td>
            <td></td>
        </tr>
    @endif
    </table>
</div>