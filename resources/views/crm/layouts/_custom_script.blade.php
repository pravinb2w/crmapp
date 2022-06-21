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
                        $('.pipeline-loader').hide();
                        if( response.status == '1' ) {
                            if( response.view){
                                $('#pipline-view').html(response.view);
                            }
                            location.reload();
                            Swal.fire('Updated!', '', 'success')

                        } else {
                            Swal.fire(response.error, '', 'error');

                        }   
                        
                    }            
                });
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
    setInterval(function() { get_notifications(); }, 6000);
    function get_notifications() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('common.notification.list') }}"+'?_token=' + '{{ csrf_token() }}',
            type: 'POST',
            
            success: function(response) {
                $('#notification_tab').html(response);
                check_notification();
            }            
        });
    }

    function make_read(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('common.notification.read') }}",
            type: 'POST',
            data: {id:id},
            success: function(response) {
                if( response.url ) {
                    window.location.href=response.url;
                } else {
                    $('#notification_tab').html(response);
                }
            }            
        });
    }

    function check_notification() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('notification.check') }}",
            type: 'POST',
            success: function(response) {
                if( response.title ) {
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr.info(response.title, response.message, { timeOut: 9500 } );
                }
            }            
        });
    }

    function activity_comments(activity_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('activities.comment.modal') }}",
            type: 'POST',
            data: {activity_id:activity_id},
            success: function(response) {
                $('#Mymodal').html(response);
                $('#Mymodal').modal('show');
            }            
        });
    }

    function comment_list(activity_id) {
        $.ajax({
            url: "{{ route('activities.comment.list') }}",
            type: 'POST',
            data: {activity_id:activity_id},
            success: function(response) {
                $('#comment_list').html(response);
            }            
        });
    }
</script>