@extends('crm.layouts.template')

@section('content')
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    #form-panel {
        padding:10px;
        border:1px solid #ddd;
    }
    .card-header label{
        font-weight:  bold !important;
        font-size: 14px !important
    }
    .p-0 {
        padding: 0 !important
    }
    tr,td {
        vertical-align: middle !important
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
                <h4 class="page-title">Add New Page</h4>
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="row m-0">
                <div class="col-12" id="error">
                </div>
            </div>  
            <form class="form-horizontal account_form" enctype="multipart/form-data" id="account_form">
                @csrf
                <div class="row m-0">
                    <div class="col-md-8">
                        <div class="row m-0 mb-3">
                            <div class="col-6 ps-md-0">
                                <div class="custom-form-group">
                                   <input type="text"  name="page_type" id="" class="form-control" placeholder="Enter the page name">
                                    <label for="" class="custom-label">Page Type</label>
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="custom-form-group">
                                    <input type="text" name="page_title" class="form-control" placeholder="Enter the page title">
                                    <label for="" class="custom-label">Page Title</label>
                                </div> 
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <label for="">Social Media links</label> 
                                <a class="btn btn-light border btn-sm" id="add_social_media">+ Add</a>
                            </div>
                            <div class="card-body">
                                <div style="max-height:150px;overflow:auto">
                                    <table class="table border-less padding-collapse m-0">
                                        <tbody id="social_medias">
                                            <tr class="mb-2">
                                                <td width="150px">
                                                    <select name="media_type[]" id="" class="form-select form-control-sm rounded-0">
                                                        <option value="">-- Choose --</option>
                                                        <option value="Instagram">Instagram</option>
                                                        <option value="YouTube">YouTube</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Twitter">Twitter</option>
                                                        <option value="Gmail">Gmail</option>
                                                        <option value="LinkedIn">LinkedIn</option>
                                                        <option value="Pinterest">Pinterest</option>
                                                        <option value="Whatsapp">Whatsapp</option>
                                                        <option value="Snapchat">Snapchat</option>
                                                        <option value="Reddit">Reddit</option>
                                                    </select>
                                                </td>
                                                <td class="mb-1"><input name="link[]" type="url" class="rounded-0 form-control-sm form-control"></td>
                                            </tr>
                                            <tr class="mb-2">
                                                <td width="150px">
                                                    <select name="media_type[]" id="" class="form-select form-control-sm rounded-0">
                                                        <option value="">-- Choose --</option>
                                                        <option value="Instagram">Instagram</option>
                                                        <option value="YouTube">YouTube</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Gmail">Gmail</option>
                                                        <option value="Twitter">Twitter</option>
                                                        <option value="LinkedIn">LinkedIn</option>
                                                        <option value="Pinterest">Pinterest</option>
                                                        <option value="Whatsapp">Whatsapp</option>
                                                        <option value="Snapchat">Snapchat</option>
                                                        <option value="Reddit">Reddit</option>
                                                    </select>
                                                </td>
                                                <td class="mb-1"><input name="link[]" type="url" class="rounded-0 form-control-sm form-control"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <label for="">Banner Sliders</label>
                                <a class="btn btn-light border btn-sm" id="add_banner_sliders">+ Add</a>
                            </div>
                            <div class="card-body p-1">
                                <div class="row m-0" id="banner_sliders">
                                    <div class="col-4 p-1">
                                        <div class="bg-light border-primary border p-2">
                                            <input placeholder="Sub Title" name="banner_title[]" type="text" class="rounded-0 form-control-sm form-control mb-1">
                                            <input placeholder="Title" name="sub_banner_title[]" type="text" class="rounded-0 form-control-sm form-control mb-1"> 
                                            <textarea name="banner_content[]" id="" cols="30" rows="5" class="rounded-0 form-control-sm form-control mb-1" placeholder="Content"></textarea>
                                            <input name="banner_image[]" type="file" class="border  shadow rounded-0 form-control-sm form-control">
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div> 
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <label for="">Contact Form</label>
                                <a class="btn btn-light border btn-sm" id="add_form_field">+ Add</a>
                            </div>
                            <div class="card-body px-0 py-3">
                                <div class="row m-0">
                                    <div class="col-4 px-3 border-end">
                                        <label class="mb-1"><i class="bi bi-telephone-fill me-1"></i> Call US</label>
                                        <input type="number" class="rounded-0 form-control-sm form-control mb-2">
                                        <label class="mb-1"><i class="bi bi-envelope-fill me-1"></i>Mall US</label>
                                        <input type="text" class="rounded-0 form-control-sm form-control mb-2">
                                        <label class="mb-1"><i class="bi bi-geo-alt-fill me-1"></i>Contact US</label>
                                        <input type="text" class="rounded-0 form-control-sm form-control">
                                    </div>
                                    <div class="col-8 px-3">
                                        <table class="table m-0 table-borderless">
                                            <thead>
                                                <tr>
                                                    <th class="py-1">Type</th>
                                                    <th class="py-1">Inner Text</th>
                                                    <th class="p-0 text-center">Required ?</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contact_form">
                                                <tr>
                                                    <td class="p-0">
                                                        <select name="" id="" class="form-select form-select-sm">
                                                            <option value="">-- select --</option>
                                                            <option value="email">Mail ID</option>
                                                            <option value="number">Phone Number</option>
                                                            <option value="text">Others</option>
                                                        </select>
                                                    </td>
                                                    <td class="p-1">
                                                        <input type="text" name="" id="" placeholder="Ex: Enter your name" class="form-control form-control-sm">
                                                    </td>
                                                    <td class="text-center p-0">
                                                        <input type="checkbox" name="" id="" class="form-check-input">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4 stick-top h-100">
                        <div class="border card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <label for="">Page Logo</label>
                                <label style="font-weight: normal !important;font-size:12px !important" for="page_logo" class="btn btn-light border btn-sm "><i class="bi bi-pencil-square me-1"></i> Change Logo</label>
                            </div>
                            <div class="card-body py-2 text-center">
                                <input type="file" name="page_logo" id="page_logo" class="form-control mb-2 d-none" onchange="previewFile(this);" >
                                <div style="width: 200px" class="border-0 mx-auto">
                                    <img id="page_logo_preview" style="width: 100%; height:80px" class="mx-auto border-0" src="https://zemez.io/html/wp-content/uploads/sites/9/2018/01/logo.png">
                                </div>
                                <b><i class="bi bi-info-circle-fill me-1"></i></b> Image size must be 200 X 80
                            </div> 
                        </div>
                        <div class="border mt-3 card">
                            <div class="card-header">
                                <label for="">GA Tags / Other Scripts</label>
                            </div>
                            <div class="card-body">
                                 <textarea name="" id="" class="form-control" cols="30" rows="6" placeholder="Paste here..."></textarea>
                            </div> 
                        </div>
                        <div class="border mt-3 card">
                            <div class="card-header">
                                <label for="">Publish</label>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div><a href="#" class="btn btn-light border">Save Darft</a></div>
                                    <div><a href="#" class="btn btn-light border">Preview</a></div>
                                </div>
                                <div class="my-1"><i class="me-2 bi bi-key-fill"></i> Status: <b>Public</b> <b>Imediately</b> <a href="#"><u>Edit</u></a></div>
                                <div class="my-1"><i class="me-2 bi bi-eye-fill"></i> Visibility: <b>Public</b> <b>Imediately</b> <a href="#"><u>Edit</u></a></div>
                                <div class="my-1"><i class="me-2 bi bi-calendar-check-fill"></i> Publish: <b>Imediately</b> <a href="#"><u>Edit</u></a></div>
                                <div class="my-1"><i class="me-2 bi bi-circle-square"></i> SEO: <b>N / A</b></div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div><a href="#" class="btn text-danger">Move to Trash</a></div>
                                    <div><button type="submit" class="btn btn-primary border">Publish</button></div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </form> 
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

        $('#textarea').each(function() {
            var simplemde = new SimpleMDE({
                element: this,
            });
        });
        $('#account_form').submit(function(e) {
            e.preventDefault();
        
            let formData = new FormData(this);
            $('#error').html("");
            $('#error').removeClass("alert alert-danger");
            $('#error').removeClass("alert alert-success");
            $.ajax({
                type:'POST',
                url: '{{ route("pages.save") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader').show();
                },
                success: (response) => {
                    if( response.status == '1') {
                        $('#error').addClass('alert alert-danger');
                        $('#error').text(response.error);
                    } else {
                        $('#error').addClass('alert alert-success');
                        get_settings_tab('profile');
                    }
                    $('.loader').hide();
                },
                error: function(response){
                    
                }
            });
            return false;
        })
        
        $(document).ready(function(){
            $("#add_social_media").click(function(){
                $("#social_medias").append(`
                    <tr>
                        <td width="150px">
                            <select name="media_type[]" id="" class="form-select form-control-sm rounded-0">
                                <option value="">-- Choose --</option>
                                <option value="Instagram">Instagram</option>
                                <option value="YouTube">YouTube</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Gmail">Gmail</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Pinterest">Pinterest</option>
                                <option value="Whatsapp">Whatsapp</option>
                                <option value="Snapchat">Snapchat</option>
                                <option value="Reddit">Reddit</option>
                            </select>
                        </td>
                        <td class="mb-1"><input name="link[]" type="url" class="rounded-0 form-control-sm form-control"> </td>
                    </tr>
                `);
            });
            $("#add_banner_sliders").click(function(){
                $("#banner_sliders").append(`
                    <div class="col-4 p-1">
                        <div class="bg-light border-primary border p-2">
                            <input placeholder="Sub Title" name="banner_title[]" type="text" class="rounded-0 form-control-sm form-control mb-1">
                            <input placeholder="Title" name="sub_banner_title[]" type="text" class="rounded-0 form-control-sm form-control mb-1"> 
                            <textarea name="banner_content[]" id="" cols="30" rows="5" class="rounded-0 form-control-sm form-control mb-1" placeholder="Content"></textarea>
                            <input name="banner_image[]" type="file" class="border  shadow rounded-0 form-control-sm form-control">
                        </div>
                    </div>
                `);
            });
            $("#add_form_field").click(function(){
                $("#contact_form").append(`
                    <tr>
                        <td class="p-0">
                            <select name="" id="" class="form-select form-select-sm">
                                <option value="">-- select --</option>
                                <option value="email">Mail ID</option>
                                <option value="number">Phone Number</option>
                                <option value="text">Others</option>
                            </select>
                        </td>
                        <td class="p-1">
                            <input type="text" name="" id="" placeholder="Ex: Enter your name" class="form-control form-control-sm">
                        </td>
                        <td class="text-center p-0">
                            <input type="checkbox" name="" id="" class="form-check-input">
                        </td>
                    </tr>
                `);
            });
        });
    </script>
    <script>
        function previewFile(input){
            var file = $("#page_logo").get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    $("#page_logo_preview").attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
 