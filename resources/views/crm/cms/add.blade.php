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
                                    <select name="page_type" id="" class="form-select">
                                        <option value="Home">Home</option>
                                        <option value="About">About Us</option>
                                        <option value="Conact">Conact Us</option>
                                    </select>
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
                        <div class="custom-form-group mb-3">                             
                            <label for="" class="custom-label">Social Media links</label>
                            <div class="p-2 bg-white border rounded">
                                <div class="text-end">
                                    <a class="btn btn-secondary btn-sm rounded-pill mb-2" id="add_social_media">+ Add</a>
                                </div>
                                <div style="max-height:150px;overflow:auto">
                                    <table class="table border-less padding-collapse m-0">
                                        <tbody id="social_medias">
                                            <tr class="mb-2">
                                                <td width="150px">
                                                    <select name="media_type[]" id="" class="form-select form-control-sm rounded-0 bg-light">
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
                                                    <select name="media_type[]" id="" class="form-select form-control-sm rounded-0 bg-light">
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
                        <div class="custom-form-group">                             
                            <label for="" class="custom-label">Banner Sliders</label>
                            <div class="p-2 bg-white border rounded">
                                <div class="text-end">
                                    <a class="btn btn-secondary btn-sm rounded-pill mb-2" id="add_banner_sliders">+ Add</a>
                                </div>
                                <table class="table border-less padding-collapse m-0">
                                    <tbody id="banner_sliders">
                                        <tr class="mb-2">
                                            <td class="mb-1"><input name="banner_title[]" type="text" class="rounded-0 form-control-sm form-control"></td>
                                            <td class="mb-1"><input name="sub_banner_title[]" type="text" class="rounded-0 form-control-sm form-control"></td>
                                            <td class="mb-1"><input name="banner_image[]" type="file" class="rounded-0 form-control-sm form-control"></td>
                                            <td class="mb-1"><input name="banner_content[]" type="text" class="rounded-0 form-control-sm form-control"></td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="border">
                            <div class="card-header">
                                <label for="">Page Logo</label>
                            </div>
                            <div class="card-body py-2 text-center">
                                <input type="file" name="page_logo" id="page_logo" class="form-control mb-2 d-none" onchange="previewFile(this);" >
                                <div style="width: 200px" class="border-0 mx-auto">
                                    <img id="previewImg" style="width: 100%; height:80px" class="mx-auto border-0" src="https://zemez.io/html/wp-content/uploads/sites/9/2018/01/logo.png">
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <label for="page_logo" class="btn btn-secondary btn-sm rounded-pill">Change Logo</label>
                            </div>
                        </div>
                        <div class="border mt-3">
                            <div class="card-header">
                                <label for="">Social Media links</label>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-secondary ">Create</button>
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

        $('textarea').each(function() {
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
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
            }
        }
        $(document).ready(function(){
            $("#add_social_media").click(function(){
                $("#social_medias").append(`
                    <tr>
                        <td width="150px">
                            <select name="media_type[]" id="" class="form-select form-control-sm rounded-0 bg-light">
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
                    <tr class="mb-2">
                        <td class="mb-1"><input name="banner_title[]" type="text" class="rounded-0 form-control-sm form-control"></td>
                        <td class="mb-1"><input name="sub_banner_title[]" type="text" class="rounded-0 form-control-sm form-control"></td>
                        <td class="mb-1"><input name="banner_image[]" type="file" class="rounded-0 form-control-sm form-control"></td>
                        <td class="mb-1"><input name="banner_content[]" type="text" class="rounded-0 form-control-sm form-control"></td>
                    </tr> 
                `);
            });
        });
    </script>
@endsection
 