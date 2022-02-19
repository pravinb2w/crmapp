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
<script src="{{ asset('assets/custom/js/effect.js') }}"></script>

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
                            console.log( response );
                            if( response.status == "1" ) {
                                Swal.fire( response.error, '', 'error')
                            } else {
                                $('#error').addClass('alert alert-success');
                                response.error.forEach(display_errors);
                                ReloadDataTableModal(page_type+'-datatable');
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
        } else if(page_type=='company') {
            return ajax_url = '{{ route("company.add") }}';
        } else if(page_type=='pagetype') {
            return ajax_url = '{{ route("pagetype.add") }}';
        } else if(page_type=='dealstages') {
            return ajax_url = '{{ route("dealstages.add") }}';
        } else if(page_type=='leadtype') {
            return ajax_url = '{{ route("leadtype.add") }}';
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
        } else if(page_type=='leadtype') {
            return ajax_url = '{{ route("leadtype.delete") }}';
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
        } else if(page_type=='leadtype') {
            return ajax_url = '{{ route("leadtype.status") }}';
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
        }
    }

    function set_url(page_type) {
        if(page_type=='roles') {
            return ajax_url = '{{ route("roles") }}';
        } else if(page_type=='users') {
            return ajax_url = '{{ route("users") }}';
        } else if(page_type=='subscriptions') {
            return ajax_url = '{{ route("subscriptions") }}';
        } else if(page_type=='company-subscriptions') {
            return ajax_url = '{{ route("company-subscriptions") }}';
        } else if(page_type=='company') {
            return ajax_url = '{{ route("company") }}';
        } else if(page_type=='pagetype') {
            return ajax_url = '{{ route("pagetype") }}';
        } else if(page_type=='dealstages') {
            return ajax_url = '{{ route("dealstages") }}';
        } else if(page_type=='leadtype') {
            return ajax_url = '{{ route("leadtype") }}';
        } else if(page_type=='leadsource') {
            return ajax_url = '{{ route("leadsource") }}';
        } else if(page_type=='country') {
            return ajax_url = '{{ route("country") }}';
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
            }
        }      
    });
}


function cus_auto_operand(id, query) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ route('autocomplete_customer_save') }}",
        method:'POST',
        data: {query:query, id:id},
        success:function(response){
            if( response.name ) {
                $('#customer').val(response.name);
                $('#customer_id').val(response.id);
                $('#result').hide();
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
                $('#lead-result').hide();
            }
        }      
    });
}

</script>
