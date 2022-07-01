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
        <label for="invoice_terms" class="col-3 col-form-label">Lead Accessiblity </label>
        <div class="col-9">
            <input type="radio" name="lead_access" id="roundrobin" value="roundrobin" @if(isset($info->company->lead_access) && $info->company->lead_access == 'roundrobin') checked @endif> 
            <label for="roundrobin">Round Robin</label>&emsp;
            <input type="radio" name="lead_access" id="visibileall" value="visibileall" @if(isset($info->company->lead_access) && $info->company->lead_access == 'visibileall') checked @endif> 
            <label for="visibileall">Visible to All</label>
        </div>
    </div>
    <div class="row mb-3">
        <label for="invoice_terms" class="col-3 col-form-label">Deal Accessiblity </label>
        <div class="col-9">
            <input type="radio" name="deal_access" id="roundrobin_deal" value="roundrobin"  @if(isset($info->company->deal_access) && $info->company->deal_access == 'roundrobin') checked @endif > 
            <label for="roundrobin_deal">Round Robin</label>&emsp;
            <input type="radio" name="deal_access" id="visibileall_deal" value="visibileall"  @if(isset($info->company->deal_access) && $info->company->deal_access == 'visibileall') checked @endif> 
            <label for="visibileall_deal">Visible to All</label>
        </div>
    </div>
    <div class="row mb-3">
        <label for="workflow_automation" class="col-3 col-form-label">Workflow Automation</label>
        <!-- Success Switch -->
        <div class="col-9">
            <input type="checkbox" name="workflow_automation" id="workflow_automation" {{ (isset($info->company->workflow_automation) && $info->company->workflow_automation == '1' )  ? 'checked' : '' }} data-switch="success"/>
            <label for="workflow_automation" data-on-label="" data-off-label=""></label>
        </div>
    </div>
    <div class="row mb-3">
        <label for="show_products" class="col-3 col-form-label">Show Products on Landing Pages</label>
        <!-- Success Switch -->
        <div class="col-9">
            <input type="checkbox" name="show_products" id="show_products" {{ (isset($info->company->show_products) && $info->company->show_products == '1' )  ? 'checked' : '' }} data-switch="success"/>
            <label for="show_products" data-on-label="" data-off-label=""></label>
        </div>
    </div>
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
                    response.error.forEach(msg => toastr.error(msg) ); 
                } else {
                    response.error.forEach(msg => toastr.success(msg) ); 
                    setTimeout(function(){
                        get_settings_tab('common');
                    },100);
                }
            },
            
        });
        return false;
    });
</script>