<div class="modal-dialog modal-lg modal-right">

    <form id="leads-form" method="POST" action="{{ route('leads.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> 
        <div class="modal-body d-flex justify-content-center h-100 p-3">
            <div class="w-100">
                <div class="row">
                    <div class="col-12" id="error"></div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="dripicons-user"></i></span>
                        <label for="name" class="col-form-label">Customer </label>                   
                        <input type="text" name="customer" id="customer" class="form-control" required value="{{ $info->customer->first_name ?? '' }}" autocomplete="off">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $info->customer_id ?? '' }}">
                        <div id="result" class="typeahead-custom"></div>
                    </div> 
                    <div class="form-group mt-1">
                        <label for="name" class="col-form-label">Organization </label>                   
                        <input type="text" name="organization" id="organization" value="{{ $info->customer->company->name ?? ''}}" class="form-control" autocomplete="off" required>
                        <input type="hidden" name="organization_id" id="organization_id" value="{{ $info->customer->organization_id ?? '' }}">
                        <div id="result-org" class="typeahead-custom"></div>
                    </div>
                    <div class="form-group mt-1">
                        <label for="name" class="col-form-label">Title </label>                   
                        <input type="text" name="title" id="title" class="form-control" value="{{ $info->lead_subject ?? '' }}" autocomplete="off" required>
                    </div>
                    <div class="form-group mt-1">
                        <label for="lead_value" class="col-form-label"> Lead Value </label>                   
                        <input type="text" name="lead_value" id="lead_value" value="{{ $info->lead_value ?? '' }}" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-6 mt-1">
                        <label for="lead_type" class="col-form-label"> Lead Stage </label>
                        <select name="lead_type" id="lead_type" class="form-control">
                            <option value="">--select--</option>
                            @if( isset($leadtype) && !empty($leadtype))
                                @foreach ($leadtype as $item)
                                    <option value="{{ $item->id }}" @if(isset($info->lead_type_id) && $info->lead_type_id == $item->id ) selected @endif > {{ $item->type }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-1">
                        <label for="lead_source" class="col-form-label"> Lead Source </label>
                        <select name="lead_source" id="lead_source" class="form-control">
                            <option value="">--select--</option>
                            @if( isset($leadsource) && !empty($leadsource))
                                @foreach ($leadsource as $item)
                                    <option value="{{ $item->id }}" @if(isset($info->lead_source_id) && $info->lead_source_id == $item->id ) selected @endif > {{ $item->source }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @if(Auth::user()->hasAccess('leads', 'is_assign'))
                    <div class="col-12 mb-4 mt-1">
                        <label for="assigned_to" class="col-form-label"> Assign To </label>
                        <select name="assigned_to" id="assigned_to" class="form-control">
                            <option value="">--select--</option>
                            @if( isset($users) && !empty($users))
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}"  @if(isset($info->assigned_to) && $info->assigned_to == $item->id ) selected @endif > {{ $item->name.' '.$item->last_name ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @else
                        <input type="hidden" name="assigned_to" id="assigned_to" value="{{ Auth::id() }}">
                    @endif
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <label for="description" class="col-form-label me-2">Status</label>
                            <div>
                                <input type="checkbox" name="status" id="switch3" data-switch="primary" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}}>
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>  
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                    <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}">
                </div>  
            </div> 
        </div>
        <div class="modal-footer">
    
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-primary" id="save">Save</button>
        
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
    $('#result').hide();
    $('#result-org').hide();
        $('#customer').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_customer', $companyCode) }}",
                    method:'POST',
                    data: {org:inputs, 'type':'lead'},
                    success:function(response){
                        $('#result').html(response);
                        $('#result').show();
                    }      
                });
        })

        $('#organization').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_org', $companyCode) }}",
                    method:'POST',
                    data: {org:inputs},
                    success:function(response){
                        $('#result-org').html(response);
                        $('#result-org').show();
                    }      
                });
        })

        $("#leads-form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    beforeSend: function() {
                        $('#error').removeClass('alert alert-danger');
                        $('#error').html('');
                        $('#error').removeClass('alert alert-success');
                        $('#save').html('Loading...');
                    },
                    success: function(response) {
                        var from = $('#from').val();
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            if( from == 'dashboard' ) {
                                window.location.href="{{ route('leads', $companyCode) }}";
                            } else {
                                ReloadDataTableModal('leads-datatable');
                            }
                            
                        }
                    }            
                });
            }
        });

        
</script>