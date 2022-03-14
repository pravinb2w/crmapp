<div id="planned">
     @include('crm.lead._planned_pane')
</div>
<div id="done">
    @include('crm.lead._done_pane')
</div>
<script>
    function change_activity_status( lead_id, activity_id, type, lead_type = '' ) {
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
                    var ajax_url = "{{ route('leads.activity-delete') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: {lead_id:lead_id, activity_id:activity_id, type:type, lead_type:lead_type},
                        success:function(response){
                            if(response.lead_id ) {
                           
                                refresh_lead_timeline( response.type, response.lead_id);
                            }
                        }      
                    });
                    Swal.fire('Updated!', '', 'success')
                } 
            })
            return false;
    }
</script>