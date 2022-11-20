<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <input type="hidden" name="type" value="{{ $type ?? '' }}">

    <div class="text-end mb-3">
        <button id="addprefRow" type="button" class="btn btn-success">Add More</button>
        <button type="submit" class="btn btn-info">Update</button>
    </div>
    <table class="table table-bordered">
        <thead class="bg-light">
            <tr>
                <th>Prefix</th>
                <th>PH/DL/LD</th>
                <th width="60px" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody  id="prefRow">            
            @if( isset($prefix) && !empty($prefix))
                @foreach ($prefix as   $item)
                    <tr id="inputFormRow">
                        <td style="padding: 0 !important"><input type="hidden" name="prefix_id[]" value="{{ $item->id }}"><input type="text" name="prefix_field[]" value="{{ $item->prefix_field }}" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required></td>
                        <td style="padding: 0 !important"><input type="text" name="prefix_value[]" value="{{ $item->prefix_value }}" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required></td>
                        <td class="text-center" style="padding: 0 !important"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
                    </tr>                     
                @endforeach           
            @else 
                <tr id="inputFormRow">
                    <td style="padding: 0 !important"><input type="hidden" name="prefix_id[]" value=""><input type="text" name="prefix_field[]" value="" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required></td>
                    <td style="padding: 0 !important"><input type="text" name="prefix_value[]" value="" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required></td>
                    <td class="text-center" style="padding: 0 !important"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
                </tr>                
            @endif
        </tbody>
    </table>

    {{-- <div class="row mb-3">
        <div class="col-12 mb-3 text-end">
            
        </div>
        <div id="prefRow">
            @if( isset($prefix) && !empty($prefix))
                @foreach ($prefix as $item)
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="hidden" name="prefix_id[]" value="{{ $item->id }}">
                            <input type="text" name="prefix_field[]" value="{{ $item->prefix_field }}" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required>
                            <input type="text" name="prefix_value[]" value="{{ $item->prefix_value }}" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required>
                            <div class="input-group-append">
                                <button id="removeprefRow" type="button" class="btn btn-danger"><i class="mdi mdi-trash-can"></i></button>
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
                            <button id="removeprefRow" type="button" class="btn btn-danger"><i class="mdi mdi-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>  --}}
</form> 
<script>

$("#addprefRow").click(function () {
    var html = '';
    html += '<div >';
    html += '<div class="input-group mb-3">';
    html += '';
    html += '>';
    html += '<div class="input-group-append">';
    html += '';
    html += '</div>';
    html += '</div>';

    $('#prefRow').append(`
        <tr id="inputFormRow">
            <td style="padding: 0 !important"><input type="text" name="prefix_field[]" value="" class="form-control m-input" placeholder="Prefix Field" autocomplete="off" required></td>
            <td style="padding: 0 !important"><input type="text" name="prefix_value[]" value="" class="form-control m-input" placeholder="PH/DL/LD" autocomplete="off" required</td>
            <td class="text-center" style="padding: 0 !important"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
        </tr>
    `);
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
            url: '{{ route("account.company.save", $companyCode) }}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if(response.error.length > 0 && response.status == "1" ) {
                    response.error.forEach(msg => toastr.error(msg) ); 
                } else {
                    response.error.forEach(msg => toastr.success(msg) ); 
                    setTimeout(function(){
                        get_settings_tab('prefix');
                    },100);
                }
            },
        });
        return false;
    });
</script>