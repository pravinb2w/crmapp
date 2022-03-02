<script>
    function make_stage_completed(stage_id, deal_id ){

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

    }
</script>