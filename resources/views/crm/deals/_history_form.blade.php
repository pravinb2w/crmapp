<div>
    <table class="table table-centered w-100 dt-responsive nowrap dataTable no-footer dtr-inline">
        <thead class="table-light">
            <tr>
                <th>Log</th>
                <th class="text-center">Added By</th>
                <th class="text-center">Date</th>
            </tr>
        </thead>
        <tbody>
        @if( (isset($info->all_activity ) && !empty($info->all_activity) ) || (isset($info->notes) && !empty($info->notes ) ) )
        @php
            $list = [];
            if( isset( $info->all_activity ) && !empty($info->all_activity ) ){
                foreach ($info->all_activity as $item){
                    $tmp['activity_type'] = $item->activity_type;
                    $tmp['subject'] = $item->subject;
                    $tmp['deal_id'] = $info->id;
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
                    $tmp['deal_id'] = $info->id;
                    $tmp['id'] = $ionotes->id;
                    $tmp['done_at'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ionotes->updated_at)->format('Y-m-d H:i:s');
                    // $tmp['done_by'] = $ionotes->updatedBy;
                    $tmp['added'] = $ionotes->added;
                    $list[] = $tmp;
                }
            }
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
            
            if( isset( $info->invoice ) && !empty( $info->invoice)) {
                foreach ($info->invoice as $inv) {
                    $tmp['activity_type'] = 'invoice';
                    $tmp['subject'] = 'Invoice Created';
                    $tmp['deal_id'] = $inv->deal_id;
                    $tmp['invoice_no'] = str_replace("/", "_", $inv->invoice_no);
                    $tmp['id'] = $inv->id;
                    $tmp['done_at'] = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inv->created_at)->format('Y-m-d H:i:s');
                    $tmp['done_by'] = '';
                    $tmp['added'] = $inv->added;
                    $tmp['pending_at'] = $inv->pending_at;
                    $tmp['approved_at'] = $inv->approved_at;
                    $tmp['rejected_at'] = $inv->rejected_at;
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
        <tr >
            <td class="w-50">
                @if($litem['activity_type'] != 'Notes' ) {{ strtoupper($litem['activity_type']) }}  - @endif {{ $litem['subject'] }}

                @if( isset( $litem['pending_at']) && !empty($litem['pending_at']) && $litem['approved_at'] == null && $litem['activity_type'] == 'invoice' )
                <span class="badge bg-info-lighten">Awaiting for Approval</span>
                @elseif( isset($litem['approved_at']) && $litem['activity_type'] == 'invoice')
                <span class="badge bg-success-lighten">Approved</span>
                @elseif( isset($litem['rejected_at']) && $litem['activity_type'] == 'invoice' )
                <span class="badge bg-danger-lighten">Rejected</span>
                @endif
                
            </td>
            <td class="text-center">
                @if( isset($litem['done_by'])&& !empty($litem['done_by']))
                    <span class="badge badge-success-lighten"> CompletedBy : {{ $litem['done_by']->name ?? '' }}</span>
                @else
                    <span class="badge badge-success-lighten"> AddedBy : {{ $litem['added']->name ?? '' }}</span>
                @endif
            </td>
            <td class="text-center">
                <small> {{ date('d M Y H:i A', strtotime($litem['done_at'] ) ); }}
                </small>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td> No History Found</td>
            <td></td>
        </tr>
    @endif
        </tbody>
    </table>
</div>

<script>
    function change_activity_status( deal_id, activity_id, lead_type = '' ) {
       var ttt = 'You are trying to delete activity';

       Swal.fire({
           title: 'Are you sure?',
           text: ttt,
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, do it!'
           }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed) {
                   var ajax_url = "{{ route('deals.activity-delete') }}";
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url: ajax_url,
                       method:'POST',
                       data: {deal_id:deal_id, activity_id:activity_id, lead_type:lead_type},
                       success:function(response){
                           if(response.deal_id ) {
                            get_tab('history', response.deal_id);
                           }
                       }      
                   });
                   Swal.fire('Updated!', '', 'success')
               } 
           })
           return false;
   }
</script>