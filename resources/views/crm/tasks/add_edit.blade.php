<div class="modal-dialog modal-lg modal-right">
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />

    <form id="tasks-form" method="POST" action="{{ route('tasks.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-center h-100 p-3" style="width: 600px">
            <div class="w-100">
                <div class="row">
                    <div class="col-12" id="error">
                    </div>
                </div>
                <div>
                    @csrf
                    <input type="hidden" name="id" value="{{ $id ?? '' }}">
                    <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}">
                    <div class="mb-3">
                        <label for="task_name" class="col-form-label">Task Name <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" name="task_name" id="task_name" class="form-control" value="{{ $info->task_name ?? '' }}" required>
                        </div>
                    </div>
                    @if(Auth::user()->hasAccess('tasks', 'is_assign'))

                    <div class="mb-3">
                        <label for="assigned_to" class="col-form-label">Assigned To<span class="text-danger">*</span></label>
                        <div>
                            <select name="assigned_to" id="assigned_to" class="form-control" required>
                                <option value="">--select</option>
                                @if(isset($users) && !empty($users))
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}" @if(isset($info->assigned_to) && $info->assigned_to == $item->id ) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
                    @endif
                    
                    <div class="mb-3">
                        <label for="description" class="col-form-label"> Description </label>
                        <div>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $info->description ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        
                        <label for="description" class="col-form-label"> Task End Date <span class="text-danger">*</span></label>
                        <div class="mb-3 col-8">
                            <input type="text" required name="end_date" id="end_date" class="form-control datepicker" value="<?= isset($info->end_date) ? date('d-m-Y', strtotime($info->end_date)): date('M d,Y')?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="col-form-label">Status</label>
                        <!-- Success Switch-->
                        <div>
                            <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                            <label for="switch3" data-on-label="" data-off-label=""></label>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-info" id="save">Save</button>
        </div>
    </form><!-- /.modal-content -->
</div>
<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <!-- SimpleMDE demo -->
    <script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>
<script>
    
    $('textarea').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
        });
    });
   
        $("#tasks-form").validate({
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
                        var from = $('#from').val();
                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('success', response.error );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            if( from == 'dashboard' ) {
                                window.location.href="{{ route('tasks', $companyCode) }}";
                            } else {
                                ReloadDataTableModal('tasks-datatable');
                            }
                        }
                    }            
                });
            }
        });

        $(function(){
        $('.datepicker').datepicker({
            format: 'M dd,yyyy',
            // endDate: '+0d',
            autoclose: true
        });
    });
</script>

@section('add_on_script')
    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>
@endsection