<div class="modal-dialog modal-lg modal-right">
    <div class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">
            <link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
            <style>
                .CodeMirror, .editor-toolbar {
                    background: rgb(255, 252, 220);
                }
                .notes-pane {
                    position: absolute;
                    bottom: 46px;
                    right: 8px;
                    z-index: 9;
                }
                /* HIDE RADIO */
                [type=radio] { 
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
                }

                /* IMAGE STYLES */
                [type=radio] + i {
                cursor: pointer;
                }

                /* CHECKED STYLES */
                [type=radio]:checked + i {
                outline: 2px solid #10b9f1;
                }

                #activitiy-icon>div>label>i {
                    padding: 5px;
                    border: 0.5px solid #ddd;
                    font-size: 20px;
                }
                #lead-activity {
                    padding:15px;
                }
                .timeinput {
                    display: inline-flex;
                    width: 100%;
                }
                .timeinput > span {
                    padding: 10px;
                }
                .w-35 {
                    width: 35% !important;
                }
                .w-80 {
                    width: 80% !important;
                }
                .w-20 {
                    width: 20% !important;
                }

                .timeline-item-left>.timeline-desk>.timeline-box {
                    background: rgb(255, 252, 220);
                }
                .dropdown {
                    position: absolute;
                    right: 0;
                    top: 0;
                }
                .editor-statusbar {
                    display: none;
                }
            </style>
            <div class="row m-0">
                <div class="col-12" id="error">
                </div>
            </div>
            <form class="form-horizontal" id="notes-form" method="POST" action="{{ route('notes.save') }}" autocomplete="off">
                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100" id="activitiy-icon">
                        {{-- if user login only then hide user dropdown, show only admin login --}}
                        <div class="form-group mt-3">
                            <span><i class="dripicons-user"></i></span>
                             <label for=""> User <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="" >--select User -- </option>

                                @if( isset($users) && !empty($users))
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}" @if( isset($info->user_id) && $info->user_id == $item->id) selected @endif > {{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <span><i class="dripicons-user"></i></span>
                            <label for="name" class="col-form-label"> Lead / Deal </label>                   
                            <input type="text" name="lead_deal" id="lead_deal" value="{{ $info->lead->lead_subject ?? '' }}" class="form-control" autocomplete="off">
                            <input type="hidden" name="lead_id" id="lead_id" value="{{ $info->lead_id ?? '' }}">
                            <input type="hidden" name="deal_id" id="deal_id">
                            <div id="lead-result" class="typeahead-custom"></div>
                            
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Notes <span class="text-danger">*</span></label>
                            <textarea name="notes" id="notes" cols="30" rows="1" required>{{ $info->notes ?? '' }}</textarea>
                        </div>
                        <div class="row mt-3">
                            <label for="description" class="col-4 col-form-label">Status</label>
                            <!-- Success Switch-->
                            <div class="col-8">
                                <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                        <div class="form-group mt-3 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                            <button type="submit"  class="btn btn-info"> Save </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>
<script>
    $(function(){
        $('.datepicker').datepicker({
            format: 'M dd,yyyy',
            // endDate: '+0d',
            autoclose: true
        });
    });
</script>
<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <!-- SimpleMDE demo -->
<script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>
<script>
    $('textarea').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
        });
    });

    $('#result').hide();
    $('#lead-result').hide();
    
    $("#notes-form").validate({
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
                        ReloadDataTableModal('notes-datatable');
                    }
                }            
            });
        }
    });

    $('#lead_deal').keyup(function(){
        var inputs = this.value;
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        $.ajax({
                url: "{{ route('autocomplete_lead_deal') }}",
                method:'POST',
                data: {org:inputs},
                success:function(response){
                    $('#lead-result').html(response);
                    $('#lead-result').show();
                }      
            });
    })  
</script>