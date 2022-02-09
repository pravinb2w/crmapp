<div class="modal-dialog modal-md modal-right">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <form class="form-horizontal modal-body" id="country-form" method="POST" action="{{ route('country.save') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <div class="row mb-3">
                    <label for="country_name" class="col-4 col-form-label">Country Name <span class="text-danger">*</span></label>
                    <div class="col-8">
                        <input type="text" name="country_name" id="country_name" class="form-control" value="{{ $info->country_name ?? '' }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="dial_code" class="col-4 col-form-label">Dial Code </label>
                    <div class="col-8">
                        <input type="text" name="dial_code" id="dial_code" class="form-control" value="{{ $info->dial_code ?? '' }}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="country_code" class="col-4 col-form-label">Country Code </label>
                    <div class="col-8">
                        <input type="text" name="country_code" id="country_code" class="form-control" value="{{ $info->country_code ?? '' }}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="currency" class="col-4 col-form-label">Currency </label>
                    <div class="col-8">
                        <input type="text" name="currency" id="currency" class="form-control" value="{{ $info->currency ?? '' }}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-4 col-form-label"> Description </label>
                    <div class="col-8">
                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $info->description ?? '' }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-4 col-form-label">Status</label>
                    <!-- Success Switch-->
                    <div class="col-8">
                        <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                        <button type="submit" class="btn btn-info" id="save">Save</button>

                    </div>
                </div>
            </form> 
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
        $("#country-form").validate({
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
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            $('#error').addClass('alert alert-success');
                            response.error.forEach(display_errors);
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            ReloadDataTableModal('country-datatable');
                        }
                    }            
                });
            }
        });

        
</script>