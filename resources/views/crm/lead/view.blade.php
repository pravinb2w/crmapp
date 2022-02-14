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

form#lead-activity>div>label>i {
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
                                    <div class="row  ">
                                        <div class="col-md-6 mb-3">
                                           <h3 class="h4 link"><a href="#" class="me-1">Praveen Phoenix Deal</a> <i class="mdi mdi-tag"></i></h3>
                                            <div class="d-flex">
                                                <div class="btn ps-0"><b class="h4">RS. 300</b></div>
                                                <div class="btn link">5 Products</div>
                                                <div class="btn"><i class="me-1 dripicons-user"></i> Praveen </div>
                                                <div class="btn"><i class="me-1 mdi-office-building mdi"></i> Phoenix</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <div class="dropdown me-2">
                                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i style="font-size:20px" class="uill uil-user-circle me-1"></i> Praveen Paul Raj
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                                <div class="btn me-2 btn-success">Won</div>
                                                <div class="btn  me-2 btn-danger">Loss</div>
                                                <div class="dropdown  me-2">
                                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-table-large"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2"> 
                                            
                                            <div class="form-group">
                                                Lead Info here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <ul class="nav nav-tabs nav-bordered mb-3 w-100">
                                    <li class="nav-item w-50">
                                        <a href="#notes" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                            <span class="d-none d-md-block"><i class="mdi mdi-note-text"></i> Notes </span>
                                        </a>
                                    </li>
                                    <li class="nav-item w-50">
                                        <a href="#activity" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                            <span class="d-none d-md-block"> <i class="mdi mdi-calendar"></i> Activity </span>
                                        </a>
                                    </li>
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="notes">
                                        <div class="form-group">
                                            <textarea name="notes" id="notes" cols="30" rows="2"></textarea>
                                            <div class="notes-pane">
                                                <button type="button" class="btn btn-light me-2" > Discard </button>
                                                <button type="button" class="btn btn-success"> Save </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="activity">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="timeline" dir="ltr">
            
                                                <div class="timeline-show mb-3 text-center">
                                                    <h5 class="m-0 time-show-name">Notes / Activity </h5>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-left">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow-alt"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16 w-80">Completed UX design project for our client</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>22 July, 2019</small></p>
                                                            <p>Dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? </p>
            
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-right">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16 w-85">Yay! We are celebrating our first admin release.</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Mark as Done</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>22 July, 2019</small></p>
            
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="timeline-show my-3 text-center">
                                                    <h5 class="m-0 time-show-name">Yesterday</h5>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-left">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow-alt"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16 w-85">We released new version of our theme Ubold.</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>21 July, 2019</small></p>
                                                            <p>3 new photo Uploaded on facebook fan page</p>
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-right">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16 w-85">We have archieved 25k sales in our themes.</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Mark as Done</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>21 July, 2019</small></p>
                                                            <p>Outdoor visit at California State Route 85 with John Boltana &amp;
                                                                Harry Piterson regarding to setup a new show room.</p>
            
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-left">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow-alt"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16 w-85">Conference call with UX team</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>21 July, 2019</small></p>
                                                            <p>Jonatha Smith added new milestone <span><a href="#">Pathek</a></span>
                                                                Lorem ipsum dolor sit amet consiquest dio</p>
            
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="timeline-show my-3 text-center">
                                                    <h5 class="m-0 time-show-name">2018</h5>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-right">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16 w-85">Join new team member Alex Smith</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Mark as Done</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>10 December, 2018</small></p>
                                                            <p>Alex Smith is a Senior Software (Full Stack) engineer with a deep passion for building usable, functional &amp; pretty web applications. </p>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
            
                                                <div class="timeline-lg-item timeline-item-left">
                                                    <div class="timeline-desk">
                                                        <div class="timeline-box">
                                                            <span class="arrow-alt"></span>
                                                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                                                            <h4 class="mt-0 mb-1 font-16">First release of Hyper admin dashboard template</h4>
                                                            <div class="dropdown">
                                                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-dots-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted"><small>16 July, 2018</small></p>
                                                            <p>Outdoor visit at California State Route 85 with John Boltana &amp;
                                                                Harry Piterson regarding to setup a new show room.</p>
                                                        </div>
                                                    </div>
                                                </div>
            
                                            </div>
                                            <!-- end timeline -->
                                        </div> <!-- end col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
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
 