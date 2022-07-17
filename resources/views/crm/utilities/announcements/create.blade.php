@extends('crm.layouts.template')

@section('content')
    
    <div class="container-fluid">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Announcement</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Announcement </h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <div class="card">
            <div class="card-header">
                <h3 class="lead">Add new announcement</h3>
            </div>
            <div class="card-body">
                <form action="{{ route("store.announcement") }}" method="POST"> @csrf
                    <div class="form-group mb-3">
                        <label for="subject" class="mb-2">Subject *</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="subject" class="mb-2">Page</label>
                        <select name="page_id" id="page_id" class="form-control">
                            <option value="">--select--</option>
                            @if( isset($pages) && !empty($pages) ) 
                            @foreach ( $pages as $page )
                                <option value="{{ $page->id }}"> {{ $page->page_title ?? '' }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="mb-2">Message</label>
                        <textarea name="message"></textarea>
                    </div>
                    {{-- <div class="x-y d-between">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item border-0"><input type="checkbox" value="1" name="show_staff" id="" class="me-2 form-check-input"> Show to staff</li>
                            <li class="list-group-item border-0"><input type="checkbox" value="1" name="show_clients" id="" class="me-2 form-check-input"> Show to clients </li>
                            <li class="list-group-item border-0"><input type="checkbox" value="1" name="show_my_name" id="" class="me-2 form-check-input"> Show my name</li>
                        </ul>
                       
                    </div> --}}
                    <div class="row">
                        <div class="col-sm-4 mt-4">
                            <input type="submit" value="Submit" class="btn btn-primary">
                            <a href="{{ route('announcement.index') }}" class="btn btn-light text-start"> Cancel </a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@section('add_on_styles')
    <link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .CodeMirror.cm-s-paper.CodeMirror-wrap {
            min-height: 380px !important
        }
    </style>
@endsection

@section('add_on_script')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'message' );
    </script>

@endsection