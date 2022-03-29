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
                        <li class="breadcrumb-item active">Create Email Template</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Email Template</h4>
            </div>
        </div>
    </div>     
    <div class="row m-0">
        <div class="col-md-8 ps-0">
            <form class="card" id="mail_template_form" action="{{ route('update.email_template', $data->id) }}" method="post">
                @csrf
                <div class="card-header list-group-item border-0 active">
                    <strong>Template Creation</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><sup class="text-danger">*</sup> Template Title</label>
                        <input type="text" name="title" value="{{ $data->title }}" class="form-control" placeholder="Type here..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Subject</label>
                        <input type="text" name="subject" value="{{ $data->subject }}" class="form-control" placeholder="Type here..." required>
                    </div>
                    <div>
                        <textarea name="content" id="MyEditor" style="height: 800px;"class="form-control" required>{{ $data->content }}</textarea>
                        <div class="mt-3 text-end">
                            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 pe-0">
            <div class="card">
                <div class="card-body p-0">
                    <ul class="list-group">
                        
                        <li class="list-group-item d-flex justify-content-between align-items-start active">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Available merge fields</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Contact Firstname</div>
                            </div>
                            <span>{contact_firstname}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Contact Lastname</div>
                            </div>
                            <span>{contact_lastname}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Client Phone Number</div>
                            </div>
                            <span>{client_phonenumber}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Client Email Id</div>
                            </div>
                            <span>{contact_email}</span>
                        </li>
                    </ul>
                </div>
            </div>
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
    <script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("MyEditor") });
        </script>
@endsection