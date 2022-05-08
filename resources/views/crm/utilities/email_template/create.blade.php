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
        <div class="col-md-12 ps-0">
            <form class="card" id="mail_template_form" action="{{ route('store.email_template') }}" method="post">
                @csrf
                <div class="card-header list-group-item border-0 active">
                    <strong>Template Creation</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><sup class="text-danger">*</sup> Template Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Type here..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Type here..." required>
                    </div>
                    <div>
                        <textarea name="content" id="mceeditor" style="height: 800px;"class="form-control mceeditor" required>
                        </textarea>
                        <div class="mt-3 text-end">
                            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
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
    <script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <script src="{{ asset('assets/tinymce-4.9.9/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#mceeditor',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endsection