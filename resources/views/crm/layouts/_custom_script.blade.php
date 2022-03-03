<script>
    


function make_stage_completed(stage_id, deal_id ){
    var ttt = 'You are trying to Start Stage';

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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('deals.make_stage_completed') }}",
                    type: 'POST',
                    data: {stage_id:stage_id,deal_id:deal_id},
                    beforeSend: function() {
                        $('.pipeline-loader').show();
                    },
                    success: function(response) {
                        if(response.status == "1" ) {
                        } else {
                            $('#pipline-view').html(response.view);
                            $('.pipeline-loader').hide();
                        }
                    }            
                });
                Swal.fire('Updated!', '', 'success')
            } 
        })
        return false;
    }

    function edit_activity(page_type, activity_id, lead_id = '', deal_id = '') {
        var ajax_url = "{{ route('activities.edit') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {page_type:page_type, activity_id:activity_id,lead_id:lead_id, deal_id:deal_id},
            // dataType:'json',
            success:function(res){
                $('#Mymodal').html(res);
                $('#Mymodal').modal('show');
            }
        })
        return false;
    }
</script>