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
<script src="{{ asset('assets/js/pages/demo.timepicker.js') }}"></script>

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
        return false;
    }

    function common_soft_delete(page_type, id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
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
                    });
                    Swal.fire('Deleted!', '', 'success')
                } 
            })
            return false;
    }

    function change_status(page_type, id, status) {
        var ttt = 'You are trying to change status Inactive';

        if( status == 1) {
            var ttt = 'You are trying to change status Active';
        }
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
                    var ajax_url = set_status_url(page_type);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: {page_type:page_type, id:id, status:status},
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
                    });
                    Swal.fire('Updated!', '', 'success')
                } 
            })
            return false;
    }

    function set_add_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles.add") }}';
        } else if(page_type=='users') {
            return ajax_url = '{{ route("users.add") }}';
        } else if(page_type=='subscriptions') {
            return ajax_url = '{{ route("subscriptions.add") }}';
        } else if(page_type=='company-subscriptions') {
            return ajax_url = '{{ route("company-subscriptions.add") }}';
        }  else if(page_type=='company') {
            return ajax_url = '{{ route("company.add") }}';
        }
    }
    function set_delete_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles.delete") }}';
        } else if(page_type=='users') {
            return ajax_url = '{{ route("users.delete") }}';
        } else if(page_type=='subscriptions') {
            return ajax_url = '{{ route("subscriptions.delete") }}';
        } else if(page_type=='company-subscriptions') {
            return ajax_url = '{{ route("company-subscriptions.delete") }}';
        }  else if(page_type=='company') {
            return ajax_url = '{{ route("company.delete") }}';
        }
    }

    function set_status_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles.status") }}';
        } else if(page_type=='users') {
            return ajax_url = '{{ route("users.status") }}';
        } else if(page_type=='subscriptions') {
            return ajax_url = '{{ route("subscriptions.status") }}';
        } else if(page_type=='company-subscriptions') {
            return ajax_url = '{{ route("company-subscriptions.status") }}';
        }  else if(page_type=='company') {
            return ajax_url = '{{ route("company.status") }}';
        }
    }
</script>