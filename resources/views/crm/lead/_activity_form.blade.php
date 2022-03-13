
<form id="lead-activites-form"  method="POST" action="{{ route('leads.save-activity') }}" autocomplete="off">
    @csrf
    <input type="hidden" name="lead_id" value="{{ $id ?? '' }}">
    <label for="">Title</label>
    <div class="form-group">
        <input type="text" name="activity_title" value="{{ $info->subject ?? '' }}" id="activity_title" placeholder="CALL" class="form-control" required>
    </div>
    <div class="btn-group mt-3">
        <label>
            <input type="radio" class="activity-title" name="activity_type" value="call" @if(isset($info->activity_type) && $info->activity_type == 'call') checked @endif>
            <i class="btn btn-light px-2 mx-1 dripicons-phone" title="Call"></i>
        </label>
        
        <label>
            <input type="radio" class="activity-title" name="activity_type" value="meeting" @if(isset($info->activity_type) && $info->activity_type == 'meeting') checked @endif>
            <i class="btn btn-light px-2 mx-1 dripicons-user-group" title="Meeting"></i>
        </label>
        <label>
            <input type="radio" class="activity-title" name="activity_type" value="deadline" @if(isset($info->activity_type) && $info->activity_type == 'deadline') checked @endif>
            <i class="btn btn-light px-2 mx-1 dripicons-flag" title="Deadline"></i>
        </label>
        <label>
            <input type="radio" class="activity-title"  name="activity_type" value="task" @if(isset($info->activity_type) && $info->activity_type == 'task') checked @endif>
            <i class="btn btn-light px-2 mx-1 dripicons-time-reverse" title="Task"></i>
        </label>
        <label>
            <input type="radio" class="activity-title"  name="activity_type" value="email" @if(isset($info->activity_type) && $info->activity_type == 'email') checked @endif>
            <i class="btn btn-light px-2 mx-1 dripicons-mail" title="Email"></i>
        </label>
        <label>
            <input type="radio" class="activity-title"  name="activity_type" value="lunch" @if(isset($info->activity_type) && $info->activity_type == 'lunch') checked @endif>
            <i class="btn btn-light px-2 mx-1 mdi mdi-food" title="Lunch"></i>
        </label>
    </div>
    <div class="form-group mt-3 timeinput">
        {{-- ------------- --}}
            <span><i class="dripicons-time-reverse"></i></span>
            <input type="text" required name="start_date" id="start_date" class="form-control datepicker" value="<?= isset($info->started_at) ? date('d-m-Y', strtotime($info->started_at)): date('M d,Y')?>">
            <input type="time" name="start_time" id="start_time" class="form-control w-15" value="<?= isset($info->started_at) ? date('h:i', strtotime($info->started_at)) : ''?>" required>
        {{-- ------------- --}}
            <span class="ml-2"><i class="dripicons-time-reverse"></i></span>
            <input type="time" name="due_time" id="due_time" class="form-control w-15" value="<?= isset($info->due_at) ? date('h:i', strtotime($info->due_at)) : ''?>" required readonly>
            <input type="text" required name="due_date" id="due_date" class="form-control datepicker" value="<?= isset($info->due_at) ? date('d-m-Y', strtotime($info->due_at)): date('M d,Y')?>">
        {{-- ------------- --}}
    </div>
    
    {{-- if user login only then hide user dropdown, show only admin login --}}
    @if(Auth::user()->hasAccess('leads', 'is_assign'))

    <div class="form-group mt-3">
        <span><i class="dripicons-user"></i></span>
        <label for=""> User </label>
        <select name="user_id" id="user_id" class="form-control" required>
            <option value="" >--select User -- </option>

            @if( isset($users) && !empty($users))
                @foreach ($users as $item)
                    <option value="{{ $item->id }}" @if( isset($info->user_id) && $info->user_id == $item->id) selected @endif > {{ $item->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    @else 
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
    @endif
    <div class="form-group mt-3 text-end">
        <button type="button" class="btn btn-light me-2" > Cancel </button>
        <button type="submit" class="btn btn-success"> Save </button>
    </div>
</form>
@section('add_on_script')
<script>
    $('.activity-title').click(function(){  
        var title = $(this).val();
        $('#activity_title').attr('placeholder', title.toUpperCase());
    });

    $('#start_time').change(function(){
        $('#due_time').attr('readonly', false);
        var times = $(this).val();

        time = times.split(':');
       
        var hour = time[0];
        var minutes = time[1];
        minutes = parseInt(time[1]) + 10;
        if( minutes >= 60){
            minutes = minutes - 60;
            minutes = '0'+minutes;
            if( hour >= 23 ) {
                hour = '00';
            } else {
                hour = parseInt(hour) + 1;
            }
        }
        var due_time = hour+':'+minutes;
        $('#due_time').val(due_time );
    })
   

    $("#lead-activites-form").validate({
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
                        form.reset();
                        if( response.type  && response.lead_id ) {
                            refresh_lead_timeline(response.type, response.lead_id);
                        }
                    }
                }            
            });
        }
    });
</script>
@endsection
