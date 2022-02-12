@extends('crm.layouts.template')

@section('content')
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    #form-panel {
        padding:10px;
        border:1px solid #ddd;
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
                        <div class="col-12" id="error">
                        </div>
                    </div>
                    <form class="form-horizontal modal-body" id="pages-form" method="POST" action="{{ route('pages.save') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                        
                        <div class="row mb-3">
                            <label for="page_id" class="col-3 col-form-label"> Page Type <span class="text-danger">*</span></label>
                            <div class="col-9">
                                <select name="page_id" id="page_id" class="form-control">
                                    <option value="">--select--</option>
                                    @if( isset($pagetype ) && !empty($pagetype))
                                        @foreach ($pagetype as $item)
                                            <option value="{{ $item->id }}">{{ $item->page }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="mobile_no" class="col-3 col-form-label"> Header Section </label>
                            <div class="col-9">
                                <textarea id="header_section" name="header_section"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mobile_no" class="col-3 col-form-label"> Body Section </label>
                            <div class="col-9">
                                <textarea id="body_section" name="body_section"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mobile_no" class="col-3 col-form-label"> Footer Section </label>
                            <div class="col-9">
                                <textarea id="footer_section" name="footer_section"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mobile_no" class="col-3 col-form-label"> Form Filed </label>
                            <div class="col-9 mb-1">
                                <input type="text" name="form_title" id="form_tile" placeholder="Form Title" class="form-control">
                                <div id="form-panel">
                                    <div class="row mt-1">
                                        <div class="col-3">
                                            {{-- <input type="text" name="field_name" id="field_name" class="form-control" placeholder="Field Name"> --}}
                                            <select name="input_type" id="input_type" class="form-control" >
                                                <option value="">-select</option>
                                                <option value="input">Name</option>
                                                <option value="input">Last Name</option>
                                                <option value="textarea"> Email</option>
                                                <option value="checkbox"> Mobile Number </option>
                                                <option value="radio"> Subject </option>
                                                <option value="radio"> Message </option>

                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <!-- Without label-->
                                            <input type="checkbox" name="is_mandatory" id="switch0" data-switch="none"/>
                                            <label for="switch0" data-on-label="" data-off-label="" style="top:7px;"></label>
                                            <span>Mandatory</span>
                                        </div>
                                        <div class="col-3">
                                            <select name="input_type" id="input_type" class="form-control" >
                                                <option value="">-select</option>
                                                <option value="input">Input Field</option>
                                                <option value="textarea"> TextArea</option>
                                                <option value="checkbox"> CheckBox </option>
                                                <option value="radio"> Radio </option>
                                            </select>
                                        </div>
                                        {{-- <div class="col-2">
                                            <a href="javascript:void(0)" class="btn btn-success">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div> --}}
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-3">
                                            <input type="text" name="field_name" id="field_name" class="form-control" placeholder="Field Name">
                                        </div>
                                        <div class="col-3">
                                            <!-- Without label-->
                                            <input type="checkbox" name="is_mandatory" id="switch2" data-switch="none"/>
                                            <label for="switch2" data-on-label="" data-off-label="" style="top:7px;"></label>
                                            <span for="switch2">Mandatory</span>
                                        </div>
                                        <div class="col-3">
                                            <select name="input_type" id="input_type" class="form-control" >
                                                <option value="">-select</option>
                                                <option value="input">Input Field</option>
                                                <option value="textarea"> TextArea</option>
                                                <option value="checkbox"> CheckBox </option>
                                                <option value="radio"> Radio </option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <a href="javascript:void(0)" class="btn btn-success">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-3">
                                            <input type="text" name="field_name" id="field_name" class="form-control" placeholder="Field Name">
                                        </div>
                                        <div class="col-3">
                                            <!-- Without label-->
                                            <input type="checkbox" name="is_mandatory" id="switch1" data-switch="none"/>
                                            <label for="switch1" data-on-label="" data-off-label="" style="top:7px;"></label>
                                            <span>Mandatory</span>
                                        </div>
                                        <div class="col-3">
                                            <select name="input_type" id="input_type" class="form-control" >
                                                <option value="">-select</option>
                                                <option value="input">Input Field</option>
                                                <option value="textarea"> TextArea</option>
                                                <option value="checkbox"> CheckBox </option>
                                                <option value="radio"> Radio </option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <a href="javascript:void(0)" class="btn btn-success">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-3 col-form-label">Status</label>
                            <!-- Success Switch-->
                            <div class="col-9">
                                <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                                <button type="submit" class="btn btn-info" id="save">Save</button>
                            </div>
                        </div>
                    </form> 
               
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

    $("#pages-form").validate({
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
                        ReloadDataTableModal('organizations-datatable');
                    }
                }            
            });
        }
    });
</script>
@endsection
 