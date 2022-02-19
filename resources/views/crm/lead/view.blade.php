@extends('crm.layouts.template')

@section('content')
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

form#activites-form>div>label>i {
    padding: 5px;
    border: 0.5px solid #ddd;
    font-size: 20px;
}
#activites-form {
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

.timeline-item-left>.timeline-desk>.timeline-box {
    background: rgb(255, 252, 220);
}
.dropdown {
    position: absolute;
    right: 0;
    top: 0;
}
</style>
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Pages </li>
                    </ol>
                </div>
                <h4 class="page-title">CMS Pages</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="row card p-4 mb-3">
                                <div class="col-12">
                                    @include('crm.lead._info')
                                </div>
                            </div>
                        </div>
                        <div class="col-12"> 
                            <div class="card shadow-sm">
                                <ul class="nav nav-pills bg-nav-pills nav-justified custom">
                                    <li class="nav-item">
                                        <a href="#Notes" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                            <i class="uil uil-pen"></i>
                                            <span>Notes</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Activity" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                                            <i class="uil uil-user"></i>
                                            <span >Activity</span>
                                        </a>
                                    </li>  
                                    <li class="nav-item">
                                        <a href="#Email" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                            <i class="uil uil-envelope-alt"></i>
                                            <span>Email</span>
                                        </a>
                                    </li> 
                                </ul>
                                
                                <div class="tab-content p-3">
                                    <div class="tab-pane active" id="Notes">
                                        <textarea name="" id="" cols="30" placeholder="Take a note's..." class="form-control" rows="10"></textarea>
                                        <div  class="text-end">
                                            <button type="button" class="btn btn-light me-2" > Discard </button>
                                            <button type="button" class="btn btn-success"> Save </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane show" id="Activity">
                                        <form action="" id="lead-activity">
                                            <div class="form-group">
                                                <input type="text" name="activity_title" id="activity_title" placeholder="Call" class="form-control">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>
                                                    <input type="radio" name="test" value="small" checked>
                                                    <i class="dripicons-phone" title="Call"></i>
                                                </label>
                                                  
                                                <label>
                                                    <input type="radio" name="test" value="big">
                                                    <i class="dripicons-user-group" title="Meeting"></i>
                                                </label>
                                                <label>
                                                    <input type="radio" name="test" value="big">
                                                    <i class="dripicons-flag" title="Deadline"></i>
                                                </label>
                                                  <label>
                                                    <input type="radio" name="test" value="big">
                                                    <i class="dripicons-time-reverse" title="Task"></i>
                                                  </label>
                                                  <label>
                                                    <input type="radio" name="test" value="big">
                                                    <i class="dripicons-mail" title="Email"></i>
                                                  </label>
                                                  <label>
                                                    <input type="radio" name="test" value="big">
                                                    <i class="mdi mdi-food" title="Lunch"></i>
                                                  </label>
                                            </div>
                                            <div class="form-group mt-3">
                                                <div class="timeinput">
                                                    <span><i class="dripicons-time-reverse"></i></span>
                                                    <input type="text" class="form-control w-98" data-provide="datepicker" data-date-container="#datepicker1">
                                                    <input type="time" class="form-control w-35" >
                                                </div>
                                                <div class="timeinput mt-3">
                                                    <span><i class="dripicons-time-reverse"></i></span>
                                                    <input type="text" class="form-control w-98" data-provide="datepicker" data-date-container="#datepicker1">
                                                    <input type="time" class="form-control w-35" >
                                                </div>
                                            </div>
                                            <div class="form-group timeinput mt-3">
                                                <span><i class="dripicons-user"></i></span>
                                                <select name="user_id" id="user_id" class="form-control">
                                                    <option value="">--select User -- </option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-3 text-end">
                                                <button type="button" class="btn btn-light me-2" > Cancel </button>
                                                <button type="button" class="btn btn-success"> Save </button>
                                            </div>
                                        </form>
                                    </div> 
                                    <div class="tab-pane" id="Email">
                                        <p>Email times</p>
                                    </div> 
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
            <div class="card">
                <div class="card-body">
                    @include('crm.lead._timeline')
                </div>
            </div>
        </div>
    </div> 
</div>
<!-- SimpleMDE js -->
@endsection
@section('add_on_script')
<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <!-- SimpleMDE demo -->
<script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>
<script>
    $('textarea').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
        });
   });
</script>
@endsection
 