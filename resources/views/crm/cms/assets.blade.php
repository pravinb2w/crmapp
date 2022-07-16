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
    .CodeMirror.cm-s-paper.CodeMirror-wrap{
        min-height:  150px !important
    }
    .custom-label {
        color: black !important
    }
</style>

<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>
<script>

    $('#textarea').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
        });
    });
   
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
                            <label for="" class="custom-label bg-white">Cover Image</label>
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
        $("#add_feature").click(function(){
            $("#features_list").append(`
                <div class="col-4 p-1" id="featurCol">
                    <div class="shadow border rounded p-2 pt-3 position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white p-0">
                            <span onclick="featureDelete(this)" class="badge badge-danger-lighten rounded-pill btn btn-sm shadow"><i class="bi fa-2x bi-x"></i></span>
                        </span>
                        <div class="custom-form-group">
                            <input name="feature_icon[]" type="file" id="" class="form-control mb-3" required>
                            <label for="" class="custom-label bg-white">Icon Image</label>
                        </div> 
                        <div class="custom-form-group">
                            <input type="text" name="feature_title[]" id="" class="form-control mb-3" required  placeholder="Type here...">
                            <label for="" class="custom-label bg-white">Ttile</label>
                        </div> 
                        <div class="custom-form-group">
                            <input type="text" name="feature_content[]" id="" class="form-control mb-3" required  placeholder="Type here...">
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
                            <option value="fullname">Full Name</option>
                            <option value="email">Email Id</option>
                            <option value="mobile_no">Mobile Number</option>
                            <option value="subject">Subject</option>
                            <option value="message">Message</option>
                        </select>
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
    function featureDelete(ctl) {
        $(ctl).parents("#featurCol").remove();
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