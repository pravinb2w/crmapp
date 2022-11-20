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
                <th>SMS Integration</th>
                <th width="60px" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="prefRow">
            @php
                // dd( $sms );
            @endphp
            @if (isset($sms) && !empty($sms))
                @foreach ($sms as $isms)
                    <tr id="inputFormRow">
                        <td style="padding: 5px !important">
                            <div class="row p-2">
                                <div class="col-6">
                                    <label for="">Sms Type</label>
                                    <select name="sms_type[]" id="sms_type" class="form-control">
                                        <option value="">--select--</option>
                                        @if (config('constant.email_type'))
                                            @foreach (config('constant.email_type') as $item)
                                                <option value="{{ $item }}"
                                                    @if (isset($isms) && $isms->sms_type == $item) selected @endif>
                                                    {{ $item }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">User Name</label>
                                    <input type="text" name="user_name[]" value="{{ $isms->user_name ?? '' }}"
                                        id="user_name" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Api Key</label>
                                    <input type="text" name="api_key[]" value="{{ $isms->api_key ?? '' }}"
                                        id="api_key" class="form-control">
                                </div>

                                <div class="col-6">
                                    <label for="">SenderId</label>
                                    <input type="text" name="sender_id[]" value="{{ $isms->sender_id ?? '' }}"
                                        id="sender_id" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Template Id (tid)</label>
                                    <input type="text" name="template_id[]" value="{{ $isms->template_id ?? '' }}"
                                        id="template_id" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Type</label>
                                    <input type="text" name="template_type[]" value="{{ $isms->type ?? '' }}"
                                        id="template_type" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Variables</label>
                                    <input type="text" name="variables[]" id="variables"
                                        value="{{ $isms->variables ?? '' }}" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label for="">Template</label>
                                    <textarea name="template[]" id="template" class="form-control" cols="10" rows="5">{{ $isms->template ?? '' }}</textarea>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="padding: 0 !important;vertical-align: middle;"><button
                                id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
                    </tr>
                @endforeach
            @else
                <tr id="inputFormRow">
                    <td style="padding: 5px !important">
                        <div class="row p-2">
                            <div class="col-6">
                                <label for="">Sms Type</label>
                                <select name="sms_type[]" id="sms_type" class="form-control">
                                    <option value="">--select--</option>
                                    @if (config('constant.email_type'))
                                        @foreach (config('constant.email_type') as $item)
                                            <option value="{{ $item }}">{{ str_replace('_', ' ', $item) }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">User Name</label>
                                <input type="text" name="user_name[]" id="user_name" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Api Key</label>
                                <input type="text" name="api_key[]" id="api_key" class="form-control">
                            </div>

                            <div class="col-6">
                                <label for="">SenderId</label>
                                <input type="text" name="sender_id[]" id="sender_id" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Template Id (tid)</label>
                                <input type="text" name="template_id[]" id="template_id" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Type</label>
                                <input type="text" name="template_type[]" id="template_type"
                                    class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Variables</label>
                                <input type="text" name="variables[]" id="variables" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="">Template</label>
                                <textarea name="template[]" id="template" class="form-control" cols="10" rows="5"></textarea>
                            </div>
                        </div>
                    </td>
                    <td class="text-center" style="padding: 0 !important;vertical-align: middle;"><button
                            id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
                </tr>
            @endif
        </tbody>
    </table>

</form>
<script>
    var count = 0;
    var sms_type = <?php echo json_encode(config('constant.email_type')); ?>;

    $("#addprefRow").click(function() {
        var html = '';
        if (sms_type) {
            for (let index = 0; index < sms_type.length; index++) {
                html += '<option value="' + sms_type[index] + '">' + sms_type[index].replace("_", " ") +
                    '</option>';
            }
        }

        count++;
        $('#prefRow').append(`
    <tr id="inputFormRow" >
                <td style="padding: 5px !important">
                    <div class="row p-2">
                        <div class="col-6">
                            <label for="">Sms Type</label>
                            <select name="sms_type[]" id="sms_type" class="form-control">
                                <option value="">--select--</option>
                                ` + html + `
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">User Name</label>
                            <input type="text" name="user_name[]" id="user_name" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Api Key</label>
                            <input type="text" name="api_key[]" id="api_key" class="form-control">
                        </div>
                        
                        <div class="col-6">
                            <label for="">SenderId</label>
                            <input type="text" name="sender_id[]" id="sender_id" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Template Id (tid)</label>
                            <input type="text" name="template_id[]" id="template_id" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Type</label>
                            <input type="text" name="template_type[]" id="template_type" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Variables</label>
                            <input type="text" name="variables[]" id="variables" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Template</label>
                            <textarea name="template[]" id="template" class="form-control" cols="10" rows="5"></textarea>
                        </div>
                    </div>
                </td>
                <td class="text-center" style="padding: 0 !important;vertical-align: middle;"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
            </tr>  
    `);
    });

    // remove row
    $(document).on('click', '#removeprefRow', function() {
        $(this).closest('#inputFormRow').remove();
    });
    $('#company_setting_form').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('#error').removeClass("alert alert-danger");
        $('#error').removeClass("alert alert-success");

        $.ajax({
            type: 'POST',
            url: '{{ route('account.company.save', $companyCode) }}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.error.length > 0 && response.status == "1") {
                    response.error.forEach(msg => toastr.error(msg));
                } else {
                    response.error.forEach(msg => toastr.success(msg));
                    setTimeout(function() {
                        get_settings_tab('sms');
                    }, 100);
                }
            },
        });
        return false;
    });
</script>
