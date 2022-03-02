@extends('crm.layouts.template')

@section('content')
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .CodeMirror, .editor-toolbar, #notes {
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
                        <li class="breadcrumb-item active">Deals</li>
                    </ol>
                </div>
                <h4 class="page-title">Overview deal </h4>
            </div>
        </div>
    </div>  

    <div class="row card p-4 mb-3">
        <div class="col-12">
            @include('crm.deals._info')
        </div>
    </div>
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
                <a href="#Files" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil-files-landscapes-alt uil"></i>
                    <span>Files</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a href="#Invoices" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil uil-invoice"></i>
                    <span>Invoices</span>
                </a>
            </li>
        </ul>
        
        <div class="tab-content p-3">
            <div class="tab-pane active" id="Notes">
                @include('crm.deals._note_form')
            </div>
            <div class="tab-pane show" id="Activity">
                @include('crm.deals._activity_form')
            </div> 
            <div class="tab-pane show" id="Files">
                @include('crm.deals._file_form')
            </div> 
            
            <div class="tab-pane" id="Invoices">
                <p>Invoices</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="lead_timeline">
            @include('crm.deals._timeline')
        </div>
    </div>
</div>


@endsection 
