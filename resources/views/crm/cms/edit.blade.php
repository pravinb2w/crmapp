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
            <form class="form-horizontal account_form" enctype="multipart/form-data" id="account_form" >
                @csrf
                <div class="row m-0">
                    <div class="col-md-8">
                        <div class="row m-0 mb-3">
                            <div class="col-6 ps-md-0">
                                <div class="custom-form-group">
                                   <input  value="{{ $result->page_type }}" type="text"  name="page_type" id="" class="form-control" required  placeholder="Enter the page name">
                                    <label for="" class="custom-label">Page Type</label>
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="custom-form-group">
                                    <input value="{{ $result->page_title }}" type="text" name="page_title" class="form-control" required placeholder="Enter the page title">
                                    <label for="" class="custom-label">Page Title</label>
                                </div> 
                            </div>
                        </div>
                        <div class="card border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <label for="">Social Media links</label> 
                                <a class="btn btn-light border btn-sm" id="add_social_media">+ Add</a>
                            </div>
                            <div class="card-body p-2">
                                
                                <div >
                                    <table class="table m-0 table-hover table-bordered rounded  ">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-1 text-center">Media Name</th>
                                                <th class="py-1 text-center">Profile Link</th>
                                                <th class="text-center"><i class="text-danger bi bi-trash"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="social_medias" >
                                            @foreach ($result->LandingPageSocialMedias as $row)
                                                <tr>
                                                    <td class="p-0">
                                                        <select name="media_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
                                                            <option value="">-- Choose -- </option>
                                                            <option {{ $row->name == 'Instagram' ? 'selected' : ''}} value="Instagram">Instagram</option>
                                                            <option {{ $row->name == 'YouTube' ? 'selected' : ''}} value="YouTube">YouTube</option>
                                                            <option {{ $row->name == 'Facebook' ? 'selected' : ''}} value="Facebook">Facebook</option>
                                                            <option {{ $row->name == 'Twitter' ? 'selected' : ''}} value="Twitter">Twitter</option>
                                                            <option {{ $row->name == 'Gmail' ? 'selected' : ''}} value="Gmail">Gmail</option>
                                                            <option {{ $row->name == 'LinkedIn' ? 'selected' : ''}} value="LinkedIn">LinkedIn</option>
                                                            <option {{ $row->name == 'Pinterest' ? 'selected' : ''}} value="Pinterest">Pinterest</option>
                                                            <option {{ $row->name == 'Whatsapp' ? 'selected' : ''}} value="Whatsapp">Whatsapp</option>
                                                            <option {{ $row->name == 'Snapchat' ? 'selected' : ''}} value="Snapchat">Snapchat</option>
                                                            <option {{ $row->name == 'Reddit' ? 'selected' : ''}} value="Reddit">Reddit</option>
                                                        </select>
                                                    </td>
                                                    <td class="p-0">
                                                        <input value="{{ $row->link }}" type="url" name="link[]" id="" placeholder="Ex: Enter your name" class="border-0 border-bottom form-control form-control-sm">
                                                    </td> 
                                                    <td class="text-center p-0"><i onclick='socialDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                                                </tr>     
                                            @endforeach 
                                        </tbody>
                                    </table>
                                     
                                </div>
                            </div>
                        </div>
                        <div class="card border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                               
                                <div class="form-check">
                                    <input type="checkbox" id="customRadio1" name="customRadio" class="form-check-input">
                                    <label class="form-check-label" for="customRadio1">Banner Sliders</label>
                                </div>
                                <a class="btn btn-light border btn-sm" id="add_banner_sliders">+ Add</a>
                            </div>
                            <div class="card-body p-1">
                                <div class="row m-0" id="banner_sliders">
                                    @foreach ($result->LandingPageBannerSliders as $row)
                                    
                                        <div class="col-md-6 col-sm-12 col-lg-4  p-1" id="bannerCol">
                                            <div class="shadow border rounded p-2 pt-3 position-relative">
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white p-0">
                                                    <span onclick="bannerDelete(this)" class="badge badge-danger-lighten rounded-pill btn btn-sm shadow"><i class="bi fa-2x bi-x"></i></span>
                                                </span>
                                                <div class="custom-form-group">
                                                    <input name="banner_image[]" type="file" id="" class="form-control mb-3" required  placeholder="Type here...">
                                                    <label for="" class="custom-label bg-white">Cover Iamge</label>
                                                </div> 
                                                <div class="custom-form-group">
                                                    <input value="{{ $row->sub_title }}" type="text" name="sub_banner_title[]" id="" class="form-control mb-3" required  placeholder="Type here...">
                                                    <label for="" class="custom-label bg-white">Sub Title</label>
                                                </div> 
                                                <div class="custom-form-group">
                                                    <input value="{{ $row->title }}" type="text" name="banner_title[]" id="" class="form-control mb-3" required  placeholder="Type here...">
                                                    <label for="" class="custom-label bg-white">Title</label>
                                                </div> 
                                                <div class="custom-form-group">
                                                    <textarea name="banner_content[]" id="" cols="30" rows="3" class="rounded-0 form-control-sm form-control" placeholder="Type here...">value="{{ $row->content }}"</textarea>
                                                    <label for="" class="custom-label bg-white">Content</label>
                                                </div>  
                                            </div>
                                        </div>
                                    @endforeach 
                                </div> 
                            </div>
                        </div> 
                        <div class="card border">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <label for="">Contact Form</label>
                                <a class="btn btn-light border btn-sm" id="add_form_field">+ Add</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="row m-0">
                                    <div class="col-4 p-3 border-end">
                                        <label class="mb-1"><i class="bi bi-telephone-fill me-1"></i> Call US</label>
                                        <input value="{{ $result->call_us }}" name="call_us" type="number" class="rounded-0 form-control-sm form-control mb-2">
                                        <label class="mb-1"><i class="bi bi-envelope-fill me-1"></i>Mall US</label>
                                        <input value="{{ $result->mail_us }}" name="mail_us" type="text" class="rounded-0 form-control-sm form-control mb-2">
                                        <label class="mb-1"><i class="bi bi-geo-alt-fill me-1"></i>Contact US</label>
                                        <input value="{{ $result->contact_us }}" name="contact_us" type="text" class="rounded-0 form-control-sm form-control">
                                    </div>
                                    <div class="col-8  p-2">
                                        <table class="table m-0 table-hover table-bordered rounded shadow">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="py-1 text-center">Type</th>
                                                    <th class="py-1 text-center">Inner Text</th>
                                                    <th class="p-0 text-center">Required ?</th>
                                                    <th class="text-center"><i class="text-danger bi bi-trash"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody id="contact_form">
                                                @foreach ($result->LandingPageFormInputs as $row)
                                                    <tr>
                                                        <td class="p-0">
                                                            <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
                                                                <option value="">-- select --</option>
                                                                <option {{ $row->input_type == 'email' ? 'selected' : "" }} value="email">Mail ID</option>
                                                                <option {{ $row->input_type == 'number' ? 'selected' : "" }} value="number">Phone Number</option>
                                                                <option {{ $row->input_type == 'text' ? 'selected' : "" }} value="text">Others</option>
                                                            </select>
                                                        </td>
                                                        <td class="p-1">
                                                            <input value="{{ $row->input_text }}" type="text" name="form_input_text[]" id="" placeholder="Ex: Enter your name" class="border-0 border-bottom form-control form-control-sm">
                                                        </td>
                                                        <td class="text-center p-0">
                                                            <select name="form_input_required[]" id="" class="form-select form-select-sm border-0 border-bottom ">
                                                                <option value="">-- select --</option>
                                                                <option {{ $row->input_required == '1' ? 'selected' : '' }} value="1">Required</option>
                                                                <option {{ $row->input_required == '0' ? 'selected' : '' }} value="0">Not required</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center"><i onclick='formDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                                                    </tr>
                                                @endforeach 
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
                                    <img id="page_logo_preview" height="60" class="mx-auto border-0" src="{{ asset('storage/'.$result->page_logo) }}">
                                </div>
                                <b><i class="bi bi-info-circle-fill me-1"></i></b> Image height must be 60px
                            </div> 
                        </div>
                        <div class="border mt-3 card">
                            <div class="card-header">
                                <label for="">GA Tags / Other Scripts</label>
                            </div>
                            <div class="card-body">
                                 <textarea name="other_tags" id="" class="form-control" cols="30" rows="6" placeholder="Paste here..."></textarea>
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
    
    <script> 
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
                        $('#error').text(response.success);
                        console.log(response);
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
                        <td class="p-0">
                            <select name="media_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
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
                        <td class="p-0">
                            <input type="url" name="link[]" id="" placeholder="Ex: Enter your name" class="border-0 border-bottom form-control form-control-sm">
                        </td> 
                        <td class="text-center p-0"><i onclick='socialDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                    </tr> 
                `);
            });
            $("#add_banner_sliders").click(function(){
                $("#banner_sliders").append(`
                    <div class="col-4 p-1" id="bannerCol">
                        <div class="shadow border rounded p-2 pt-3 position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white p-0">
                                <span onclick="bannerDelete(this)" class="badge badge-danger-lighten rounded-pill btn btn-sm shadow"><i class="bi fa-2x bi-x"></i></span>
                            </span>
                            <div class="custom-form-group">
                                <input name="banner_image[]" type="file" id="" class="form-control mb-3" required  placeholder="Type here...">
                                <label for="" class="custom-label bg-white">Cover Iamge</label>
                            </div> 
                            <div class="custom-form-group">
                                <input type="text" name="sub_banner_title[]" id="" class="form-control mb-3" required  placeholder="Type here...">
                                <label for="" class="custom-label bg-white">Sub Title</label>
                            </div> 
                            <div class="custom-form-group">
                                <input type="text" name="banner_title[]" id="" class="form-control mb-3" required  placeholder="Type here...">
                                <label for="" class="custom-label bg-white">Title</label>
                            </div> 
                            <div class="custom-form-group">
                                <textarea name="banner_content[]" id="" cols="30" rows="3" class="rounded-0 form-control-sm form-control" placeholder="Type here..."></textarea>
                                <label for="" class="custom-label bg-white">Content</label>
                            </div>  
                        </div>
                    </div>
                `);
            });
            $("#add_form_field").click(function(){
                $("#contact_form").append(`
                    <tr>
                        <td class="p-0">
                            <select name="form_input_type[]" id="" class="form-select form-select-sm border-0 border-bottom ">
                                <option value="">-- select --</option>
                                <option value="email">Mail ID</option>
                                <option value="number">Phone Number</option>
                                <option value="text">Others</option>
                            </select>
                        </td>
                        <td class="p-1">
                            <input type="text" name="form_input_text[]" id="" placeholder="Ex: Enter your name" class=" border-0 border-bottom form-control form-control-sm">
                        </td>
                        <td class="text-center p-0">
                            <select name="form_input_required[]" id="" class="form-select form-select-sm border-0 border-bottom ">
                                <option value="">-- select --</option>
                                <option value="1">Required</option>
                                <option value="0">Not required</option>
                            </select>
                        </td>
                        <td class="text-center"><i onclick='formDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                    </tr>
                `);
            });
        });

        function formDelete(ctl) {
            $(ctl).parents("tr").remove();
        }
        function socialDelete(ctl) {
            $(ctl).parents("tr").remove();
        }
        function bannerDelete(ctl) {
            $(ctl).parents("#bannerCol").remove();
        }
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
 