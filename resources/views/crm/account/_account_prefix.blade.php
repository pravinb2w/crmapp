<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <input type="hidden" name="type" value="{{ $type ?? '' }}">
    <div class="row mb-3">
        <div id="prefRow">
            @if( isset($prefix) && !empty($prefix))
                @foreach ($prefix as $item)
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="hidden" name="prefix_id[]" value="{{ $item->id }}">
                            <input type="text" name="prefix_field[]" value="{{ $item->prefix_field }}" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required>
                            <input type="text" name="prefix_value[]" value="{{ $item->prefix_value }}" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required>
                            <div class="input-group-append">
                                <button id="removeprefRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else 
                <div id="inputFormRow">
                    <div class="input-group mb-3">
                        <input type="hidden" name="prefix_id[]" value="">
                        <input type="text" name="prefix_field[]" value="" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required>
                        <input type="text" name="prefix_value[]" value="" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required>
                        <div class="input-group-append">
                            <button id="removeprefRow" type="button" class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
            @endif
            </div>
            <div class="col-12">
                <button id="addprefRow" type="button" class="btn btn-success w-100">Add More</button>
            </div>
    </div>
    
    <div class="justify-content-end row">
        <div class="col-12">
            <button type="submit" class="btn btn-info w-100">Update</button>
        </div>
    </div>
</form> 
<script>

$("#addprefRow").click(function () {
    var html = '';
    html += '<div id="inputFormRow">';
    html += '<div class="input-group mb-3">';
    html += '<input type="text" name="prefix_field[]" value="" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required>';
    html += '<input type="text" name="prefix_value[]" value="" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required>';
    html += '<div class="input-group-append">';
    html += '<button id="removeprefRow" type="button" class="btn btn-danger">Remove</button>';
    html += '</div>';
    html += '</div>';

    $('#prefRow').append(html);
});

// remove row
$(document).on('click', '#removeprefRow', function () {
    $(this).closest('#inputFormRow').remove();
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
                        get_settings_tab('prefix');
                    },100);
                }
            },
            
        });
        return false;
    });
</script>