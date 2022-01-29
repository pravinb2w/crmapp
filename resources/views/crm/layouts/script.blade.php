<!-- bundle -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<!-- Apex js -->
<script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>

<!-- Todo js -->
<script src="{{ asset('assets/js/ui/component.todo.js') }}"></script>

<!-- demo app -->
{{-- <script src="{{ asset('assets/js/pages/demo.dashboard-crm.js') }}"></script> --}}
<!-- end demo js-->
<script>

    function display_errors( item, index) {
        $('#error').append('<div>'+item+'</div>');
    }

    function get_add_modal(page_type, id = '') {
        var ajax_url = set_add_url(page_type);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {page_type:page_type, id:id},
            // dataType:'json',
            success:function(res){
                $('#Mymodal').html(res);
                $('#Mymodal').modal('show');
            }
        })
    }

    function common_soft_delete(page_type, id) {
        
        var ajax_url = set_delete_url(page_type);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {page_type:page_type, id:id},
            success:function(response){
                if(response.error.length > 0 && response.status == "1" ) {
                    $('#error').addClass('alert alert-danger');
                    response.error.forEach(display_errors);
                } else {
                    $('#error').addClass('alert alert-success');
                    response.error.forEach(display_errors);
                    ReloadDataTableModal(page_type+'-datatable');
                }
            }
        })
    }

    function set_add_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles.add") }}';
        }
    }
    function set_delete_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles.delete") }}';
        }
    }
</script>