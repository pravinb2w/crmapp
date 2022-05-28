<!-- bundle -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- Apex js -->
<script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>

<!-- Todo js -->
<script src="{{ asset('assets/js/ui/component.todo.js') }}"></script>
<!-- demo app -->
{{-- <script src="{{ asset('assets/js/pages/demo.dashboard-crm.js') }}"></script> --}}
<!-- end demo js-->
<script src="{{ asset('assets/js/pages/demo.timepicker.js') }}"></script>
<script src="{{ asset('assets/custom/js/effect.js') }}"></script>

<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <!-- SimpleMDE demo -->
<script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>

<script>
   

    function display_errors( item, index) {
        $('#error').append('<div>'+item+'</div>');
    }

    function display_toast( item, index) {
        toastr.error('Error', item );
    }


    function get_add_modal(page_type, id = '', from = '') {
        var ajax_url = set_add_url(page_type);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {page_type:page_type, id:id,from:from},
            // dataType:'json',
            success:function(res){
                $('#Mymodal').html(res);
                $('#Mymodal').modal('show');
            }
        })
        return false;
    }

    function view_modal(page_type, id = '') {
        var ajax_url = set_view_url(page_type);
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
                    if( page_type == 'lead_delete') {
                        var page_url = 'lead_delete';
                        page_type = 'leads';
                    } else if( page_type == 'deal_delete' ) {
                        var page_url = 'deal_delete';
                        page_type = 'deals';
                    }
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
                            console.log( response );
                            if( response.status == "1" ) {
                                Swal.fire( response.error, '', 'error')
                            } else {
                                $('#error').addClass('alert alert-success');
                                response.error.forEach(display_errors);
                                if( page_url ) {
                                    window.location.href = "{{ route('leads') }}";
                                } else {
                                    ReloadDataTableModal(page_type+'-datatable');

                                }
                                Swal.fire('Deleted!', '', 'success')
                            }
                        }      
                    });
                    
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
                                Swal.fire( response.error, '', 'error')
                            } else {
                                Swal.fire('Updated!', '', 'success')
                                ReloadDataTableModal(page_type+'-datatable');
                            }
                        }      
                    });
                   
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
        } else if(page_type=='company') {
            return ajax_url = '{{ route("company.add") }}';
        } else if(page_type=='pagetype') {
            return ajax_url = '{{ route("pagetype.add") }}';
        } else if(page_type=='dealstages') {
            return ajax_url = '{{ route("dealstages.add") }}';
        } else if(page_type=='leadstage') {
            return ajax_url = '{{ route("leadstage.add") }}';
        } else if(page_type=='leadsource') {
            return ajax_url = '{{ route("leadsource.add") }}';
        } else if(page_type=='country') {
            return ajax_url = '{{ route("country.add") }}';
        } else if(page_type=='customers') {
            return ajax_url = '{{ route("customers.add") }}';
        } else if(page_type=='organizations') {
            return ajax_url = '{{ route("organizations.add") }}';
        } else if(page_type=='teams') {
            return ajax_url = '{{ route("teams.add") }}';
        } else if(page_type=='products') {
            return ajax_url = '{{ route("products.add") }}';
        } else if(page_type=='tasks') {
            return ajax_url = '{{ route("tasks.add") }}';
        } else if(page_type=='activities') {
            return ajax_url = '{{ route("activities.add") }}';
        } else if(page_type=='leads') {
            return ajax_url = '{{ route("leads.add") }}';
        } else if(page_type=='notes') {
            return ajax_url = '{{ route("notes.add") }}';
        } else if(page_type=='permissions') {
            return ajax_url = '{{ route("permissions.add") }}';
        } else if(page_type=='deals') {
            return ajax_url = '{{ route("deals.add") }}';
        } else if(page_type=='taxgroup') {
            return ajax_url = '{{ route("tax.add") }}';
        } else if(page_type=='automation') {
            return ajax_url = '{{ route("automation.add") }}';
        }
    }

    function set_view_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles.view") }}';
        } else if(page_type=='users') {
            return ajax_url = '{{ route("users.view") }}';
        } else if(page_type=='subscriptions') {
            return ajax_url = '{{ route("subscriptions.view") }}';
        } else if(page_type=='company-subscriptions') {
            return ajax_url = '{{ route("company-subscriptions.view") }}';
        } else if(page_type=='company') {
            return ajax_url = '{{ route("company.view") }}';
        } else if(page_type=='pagetype') {
            return ajax_url = '{{ route("pagetype.view") }}';
        } else if(page_type=='dealstages') {
            return ajax_url = '{{ route("dealstages.view") }}';
        } else if(page_type=='leadstage') {
            return ajax_url = '{{ route("leadstage.view") }}';
        } else if(page_type=='leadsource') {
            return ajax_url = '{{ route("leadsource.view") }}';
        } else if(page_type=='country') {
            return ajax_url = '{{ route("country.view") }}';
        } else if(page_type=='customers') {
            return ajax_url = '{{ route("customers.view") }}';
        } else if(page_type=='organizations') {
            return ajax_url = '{{ route("organizations.view") }}';
        } else if(page_type=='teams') {
            return ajax_url = '{{ route("teams.view") }}';
        } else if(page_type=='products') {
            return ajax_url = '{{ route("products.view") }}';
        } else if(page_type=='tasks') {
            return ajax_url = '{{ route("tasks.view") }}';
        } else if(page_type=='activities') {
            return ajax_url = '{{ route("activities.view") }}';
        } else if(page_type=='notes') {
            return ajax_url = '{{ route("notes.view") }}';
        } else if(page_type=='permissions') {
            return ajax_url = '{{ route("permissions.view") }}';
        } else if(page_type=='taxgroup') {
            return ajax_url = '{{ route("tax.view") }}';
        } else if(page_type=='payments') {
            return ajax_url = '{{ route("payments.view") }}';
        } else if(page_type=='automation') {
            return ajax_url = '{{ route("automation.view") }}';
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
        } else if(page_type=='company') {
            return ajax_url = '{{ route("company.delete") }}';
        } else if(page_type=='pagetype') {
            return ajax_url = '{{ route("pagetype.delete") }}';
        } else if(page_type=='dealstages') {
            return ajax_url = '{{ route("dealstages.delete") }}';
        } else if(page_type=='leadstage') {
            return ajax_url = '{{ route("leadstage.delete") }}';
        } else if(page_type=='leadsource') {
            return ajax_url = '{{ route("leadsource.delete") }}';
        } else if(page_type=='country') {
            return ajax_url = '{{ route("country.delete") }}';
        } else if(page_type=='organizations') {
            return ajax_url = '{{ route("organizations.delete") }}';
        } else if(page_type=='teams') {
            return ajax_url = '{{ route("teams.delete") }}';
        } else if(page_type=='products') {
            return ajax_url = '{{ route("products.delete") }}';
        } else if(page_type=='tasks') {
            return ajax_url = '{{ route("tasks.delete") }}';
        } else if(page_type=='customers') {
            return ajax_url = '{{ route("customers.delete") }}';
        } else if(page_type=='activities') {
            return ajax_url = '{{ route("activities.delete") }}';
        } else if(page_type=='leads') {
            return ajax_url = '{{ route("leads.delete") }}';
        } else if(page_type=='notes') {
            return ajax_url = '{{ route("notes.delete") }}';
        } else if(page_type=='permissions') {
            return ajax_url = '{{ route("permissions.delete") }}';
        } else if(page_type=='deals') {
            return ajax_url = '{{ route("deals.delete") }}';
        } else if(page_type=='taxgroup') {
            return ajax_url = '{{ route("tax.delete") }}';
        } else if(page_type=='payments') {
            return ajax_url = '{{ route("payments.delete") }}';
        } else if(page_type=='automation') {
            return ajax_url = '{{ route("automation.delete") }}';
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
        } else if(page_type=='company') {
            return ajax_url = '{{ route("company.status") }}';
        } else if(page_type=='pagetype') {
            return ajax_url = '{{ route("pagetype.status") }}';
        } else if(page_type=='dealstages') {
            return ajax_url = '{{ route("dealstages.status") }}';
        } else if(page_type=='leadstage') {
            return ajax_url = '{{ route("leadstage.status") }}';
        } else if(page_type=='leadsource') {
            return ajax_url = '{{ route("leadsource.status") }}';
        } else if(page_type=='country') {
            return ajax_url = '{{ route("country.status") }}';
        } else if(page_type=='organizations') {
            return ajax_url = '{{ route("organizations.status") }}';
        } else if(page_type=='teams') {
            return ajax_url = '{{ route("teams.status") }}';
        } else if(page_type=='products') {
            return ajax_url = '{{ route("products.status") }}';
        } else if(page_type=='tasks') {
            return ajax_url = '{{ route("tasks.status") }}';
        } else if(page_type=='customers') {
            return ajax_url = '{{ route("customers.status") }}';
        } else if(page_type=='activities') {
            return ajax_url = '{{ route("activities.status") }}';
        } else if(page_type=='leads') {
            return ajax_url = '{{ route("leads.status") }}';
        } else if(page_type=='notes') {
            return ajax_url = '{{ route("notes.status") }}';
        } else if(page_type=='deals') {
            return ajax_url = '{{ route("deals.status") }}';
        } else if(page_type=='taxgroup') {
            return ajax_url = '{{ route("tax.status") }}';
        } else if(page_type=='automation') {
            return ajax_url = '{{ route("automation.status") }}';
        }
    }

    // Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

setInputFilter(document.getElementById("phone"), function(value) {
  return /^-?\d*$/.test(value); });

function org_auto_operand(id, query) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ route('autocomplete_org_save') }}",
        method:'POST',
        data: {query:query, id:id},
        success:function(response){
            if( response.name ) {
                $('#organization').val(response.name);
                $('#organization_id').val(response.id);
                $('#result').hide();
                $('#result-org').hide();

            }
        }      
    });
}

function cus_auto_operand(id, query, type = '') {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ route('autocomplete_customer_save') }}",
        method:'POST',
        data: {query:query, id:id, type:type},
        success:function(response){
            if( response.name ) {
                $('#customer').val(response.name);
                $('#customer_id').val(response.id);
                $('#result').hide();
                if(response.company) {
                    $('#organization').val(response.company);
                    $('#organization_id').val(response.company_id);
                }
            }
        }      
    });
}

function leade_deal_set(id, lead_type ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ route('autocomplete_lead_deal_set') }}",
        method:'POST',
        data: {lead_type:lead_type, id:id},
        success:function(response){
            if( response.name ) {
                $('#lead_deal').val(response.name);
                if( response.type == 'lead') {
                    $('#lead_id').val(response.id);
                } 
                if( response.type == 'deal') {
                    $('#deal_id').val(response.id);
                } 
                if( response.customer ) {
                    $('#customer').val(response.customer);
                    $('#customer_id').val(response.customer_id);
                }
                $('#lead-result').hide();
            }
        }      
    });
}

function mark_as_done(id, lead_id='' , type = '') {
    var ttt = 'You are trying to complete Activity';

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
                var ajax_url = "{{ route('activities.mark_as_done') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: ajax_url,
                    method:'POST',
                    data: {id:id, lead_id:lead_id, type:type},
                    success:function(response){
                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Errors', response.error );
                        } else {
                            toastr.success('Success', response.error );
                            if( response.page_type ) {
                                ReloadDataTableModal(response.page_type+'-datatable');
                            } else {
                                if( response.lead_id ) {
                                    get_tab('history', response.lead_id);
                                }
                                if( response.deal_id ) {
                                    get_tab('history', response.deal_id);
                                }
                            }
                        }
                    }      
                });
                Swal.fire('Updated!', '', 'success')
            } 
        })
        return false;
    }

    function refresh_lead_timeline(type, lead_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('leads.refresh-timeline') }}",
            method:'POST',
            data: {type:type, lead_id:lead_id},
            success:function(response){
               $('#'+type).html(response);
            }      
        });

    }

    

    function get_deal_modal(lead_id = '', id = '') {
        if( lead_id ){
            var planned = $('#planned_count').val();
            planned = parseInt(planned);
            if( planned > 0 ) {
                check_activity_done(lead_id);
            } else {
                open_deal_modal(lead_id, id);
            }
        }
        
    }

    function open_deal_modal(lead_id='', id=''){
        var ajax_url = "{{ route('deals.add') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {lead_id:lead_id, id:id},
            // dataType:'json',
            success:function(res){
                $('#Mymodal').html(res);
                $('#Mymodal').modal('show');
            }
        })
        return false;
    }

    function check_activity_done(lead_id) {
        var ttt = 'You have un completed activity, if you continue further all activity mark as done';

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
                var ajax_url = "{{ route('leads.mark_as_done') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: ajax_url,
                    method:'POST',
                    data: {lead_id:lead_id},
                    async: true,
                    success:function(response){
                        if(response.error.length > 0 && response.status == "1" ) {
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            open_deal_modal(response.lead_id);
                        }
                    }      
                });
                Swal.fire('Updated!', '', 'success')
            } 
        })
        return false;
    }

    function refresh_deal_timeline(type, deal_id, done_type = '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('deals.refresh-timeline') }}",
            method:'POST',
            data: {type:type, deal_id:deal_id, done_type:done_type},
            success:function(response){
               $('#'+type).html(response);
            }      
        });

    }

    function insert_deal_notes() {
        
        var form_data = $('#deal-insert-notes').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('deals.save-notes') }}",
            type: 'POST',
            data: form_data,
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                if(response.error.length > 0 && response.status == "1" ) {
                    toastr.error('Errors', response.error );
                } else {
                    $('#notes').val('');
                    get_deal_common_sub_list(response.deal_id, 'notes');
                    toastr.success('Success', response.error );
                }
            }            
        });
    }

    function get_deal_common_sub_list(deal_id, list_type) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('deals.common.list') }}",
            type: 'POST',
            data: {'deal_id':deal_id,'list_type':list_type},
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                $('#deal-sub-list').show();
                $('#deal-sub-list').html(response);
            }            
        });
    }

    function insert_deal_files() {
        
        let formData = new FormData(document.getElementById('deal-insert-files'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('deals.save-files') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                if(response.error.length > 0 && response.status == "1" ) {
                    toastr.error('Errors', response.error );
                } else {
                    var form = $('#deal-insert-files')[0];
                    form.reset();
                    get_deal_common_sub_list(response.deal_id, 'file');
                    toastr.success('Success', response.error );
                }
            }            
        });
    }
    
</script>
@include('crm.layouts._custom_script')