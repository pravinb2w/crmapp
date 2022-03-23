<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<style>
     .CodeMirror.cm-s-paper.CodeMirror-wrap {
             height: auto !important; 
            min-height: 50px !important;
        }
</style>
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />

<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <input type="hidden" name="type" value="{{ $type ?? '' }}">
    <div class="row mb-3">
        <label for="invoice_terms" class="col-3 col-form-label">Invoice Terms and Condition </label>
        <div class="col-9">
            <textarea name="invoice_terms" id="invoice_terms" class="form-control" cols="30" rows="4">{{ $info->company->invoice_terms ?? ''  }}</textarea>
        </div>
    </div>
    
    <div class="justify-content-end row">
        <div class="col-9">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </div>
</form> 
<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <!-- SimpleMDE demo -->
<script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>
<script>
    $('textarea').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
        });
    });
    $('#company_setting_form').submit(function(e) {
        e.preventDefault();
       
        let formData = new FormData(this);
        $('#error').removeClass("alert alert-danger");
        $('#error').removeClass("alert alert-success");

        $.ajax({
            type:'POST',
            url: '{{ route("account.company.save") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if(response.error.length > 0 && response.status == "1" ) {
                    $('#error').addClass('alert alert-danger');
                    response.error.forEach(display_errors);
                } else {
                    $('#error').addClass('alert alert-success');
                    response.error.forEach(display_errors);
                    setTimeout(function(){
                        get_settings_tab('common');
                    },100);
                }
            },
            
        });
        return false;
    });
</script>