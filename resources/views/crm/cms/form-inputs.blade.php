<div class="row m-0">
    <div class="col-md-8">
        <div class="row m-0 mb-3">
            <div class="col-6 ps-md-0">
                <div class="custom-form-group">
                   <input type="text" name="page_type"   value="{{ $result->page_type ?? ''}}" class="form-control" required  placeholder="Enter the page name">
                    <label for="" class="custom-label">Page Name</label>
                </div> 
            </div>
            <div class="col-6">
                <div class="custom-form-group">
                    <input type="text" name="page_title" value="{{ $result->page_title ?? ''}}"  class="form-control" required placeholder="Enter the page title">
                    <label for="" class="custom-label">Page Title</label>
                </div> 
            </div> 
        </div> 
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
                <label>Banner Sliders </label>
                <a class="btn btn-light border btn-sm" id="add_banner_sliders">+ Add</a>
            </div>
            <div class="card-body p-1">
                <div class="row m-0" id="banner_sliders">
                    @php
                        // dd( $result->LandingPageBannerSliders );
                    @endphp
                    @if ( isset($result->LandingPageBannerSliders) && !empty($result->LandingPageBannerSliders))
                        @foreach ($result->LandingPageBannerSliders as $row)
                            <div class="col-4 p-1" id="bannerCol">
                                <div class="shadow border rounded p-2 pt-3 position-relative">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white p-0">
                                        <span onclick="bannerDelete(this)" class="badge badge-danger-lighten rounded-pill btn btn-sm shadow"><i class="bi fa-2x bi-x"></i></span>
                                    </span>
                                    <div class="custom-form-group text-center">
                                        <img src="{{ $row->image }}" alt="" width="105px;">
                                    </div>
                                    <div class="custom-form-group">
                                        <input name="banner_image[]" type="file" value="" class="form-control mb-3"placeholder="Type here...">
                                        <input name="banner_image_data_url[]" type="hidden" value="{{ $row->image }}" class="form-control mb-3" placeholder="Type here...">
                                        <label for="" class="custom-label bg-white">Cover Image </label>
                                    </div> 
                                    
                                    <div class="custom-form-group">
                                        <input type="text" name="banner_title[]" value="{{ $row->title }}" class="form-control mb-3" required  placeholder="Type here...">
                                        <label for="" class="custom-label bg-white">Title</label>
                                    </div>
                                    <div class="custom-form-group">
                                        <input type="text" name="sub_banner_title[]" value="{{ $row->sub_title }}" class="form-control mb-3" required  placeholder="Type here...">
                                        <label for="" class="custom-label bg-white">Sub Title</label>
                                    </div> 
                                    <div class="custom-form-group">
                                        <input type="text" name="tags[]" value="{{ $row->tags ?? '' }}" class="form-control mb-3"  placeholder="Type here...">
                                        <label for="" class="custom-label bg-white">Tags</label>
                                    </div> 
                                    <div class="custom-form-group">
                                        <textarea name="banner_content[]" value="" cols="30" rows="3" class="rounded-0 form-control-sm form-control" placeholder="Type here...">{{ $row->content }}</textarea>
                                        <label for="" class="custom-label bg-white">Content</label>
                                    </div>  
                                </div>
                            </div> 
                        @endforeach 
                        @else
                            @for ($i=0;$i<3;$i++)
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
                            @endfor
                    @endif
                </div> 
            </div>
        </div>  
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
               <label>About Us </label>  
            </div>
            <div class="card-body ">    
                <div class="row m-0 align-items-center">
                    <div class="custom-form-group col px-0 d-flex pe-1 align-items-center">
                        @if ($result->file_about ?? "")
                            <div  >
                                <img src="{{ $result->file_about }}" width="100px" class="me-2 mb-3">
                            </div>
                        @endif
                        <div class="w-100">
                            <div class="text-mute"><small>Img Dimension : 570px x 340px (Minimum)</small></div>

                            @if ($result ?? '')
                                <input type="hidden" name="about_image_data_url"  class="form-control mb-2 d-one"  value="{{ $result->file_about}}">
                                <input type="file" name="about_image"  class="form-control mb-3" >
                            @else
                                <input type="file" name="about_image" id="" class="form-control mb-3" required  placeholder="Type here...">
                            @endif 
                            <label for="" class="custom-label bg-white">About Image</label>

                        </div>
                    </div> 
                    <div class="custom-form-group col px-0 ps-1 mt-2 ">
                        <input type="text" name="about_title"  value="{{ $result->about_title ?? '' }}" class="form-control mb-3 mt-1" required  placeholder="Type here...">
                        <label for="" class="custom-label bg-white">About Heading</label>
                    </div> 
                </div>
                <div class="custom-form-group">
                    <textarea name="about_content" id="textarea" cols="30" rows="10" class="rounded-0 form-control-sm form-control" placeholder="Type here...">{{ $result->about_content ?? '' }}</textarea>
                    <label for="" class="custom-label bg-white">About Content</label>
                </div>   
            </div>
        </div>
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
                <label>CRM Features</label>
                <a class="btn btn-light border btn-sm" id="add_feature">+ Add</a>
            </div>
            <div class="card-body p-1">
                <div class="row m-0" id="features_list">
                    @if ( isset($result->LandingPageFeatures) && !empty($result->LandingPageFeatures))
                        @foreach ($result->LandingPageFeatures as $row)
                            <div class="col-4 p-1" id="featurCol">
                                <div class="shadow border rounded p-2 pt-3 position-relative">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white p-0">
                                        <span onclick="featureDelete(this)" class="badge badge-danger-lighten rounded-pill btn btn-sm shadow"><i class="bi fa-2x bi-x"></i></span>
                                    </span>
                                    <div class="custom-form-group text-center">
                                        <img src="{{ $row->icon }}" alt="" width="45px;">
                                    </div>
                                    <div class="custom-form-group">
                                        <input name="feature_icon[]" type="file" id="" class="form-control mb-3" placeholder=""  >
                                        <input name="feature_icon_data_url[]" type="hidden" value="{{ $row->icon }}"  class="form-control mb-3" >
                                        <label for="" class="custom-label bg-white">Icon Image (45px*45px)</label>
                                    </div> 
                                    <div class="custom-form-group">
                                        <input type="text" name="feature_title[]" value="{{ $row->title }}" class="form-control mb-3" required  placeholder="Type here...">
                                        <label for="" class="custom-label bg-white">Ttile</label>
                                    </div> 
                                    <div class="custom-form-group">
                                        <input type="text" name="feature_content[]" value="{{ $row->content }}" class="form-control mb-3" required  placeholder="Type here...">
                                        <label for="" class="custom-label bg-white">Content</label>
                                    </div>  
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="col-4 p-1" id="featurCol">
                            <div class="shadow border rounded p-2 pt-3 position-relative">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white p-0">
                                    <span onclick="featureDelete(this)" class="badge badge-danger-lighten rounded-pill btn btn-sm shadow"><i class="bi fa-2x bi-x"></i></span>
                                </span>
                                <div class="custom-form-group">
                                    <input name="feature_icon[]" type="file" id="" class="form-control mb-3" required>
                                    <label for="" class="custom-label bg-white">Icon Image (45px*45px)</label>
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
                    @endif 
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
                        <label class="mb-1"><i class="bi bi-telephone-fill me-1"></i> Call us</label>
                        <input value="{{ $result->call_us ?? ''}}" name="call_us" type="number" class="rounded-0 form-control-sm form-control mb-3" required>
                        <label class="mb-1"><i class="bi bi-envelope-fill me-1"></i>Mall us</label>
                        <input value="{{ $result->mail_us ?? ''}}" name="mail_us" type="text" class="rounded-0 form-control-sm form-control mb-3" required> 
                        <label class="mb-1"><i class="bi bi-geo-alt-fill me-1"></i>Contact us</label>
                        <input value="{{ $result->contact_us ?? ''}}" name="contact_us" type="text" class="rounded-0 form-control-sm form-control" required>
                    </div>
                    <div class="col-8  p-2">
                        <table class="table m-0 table-hover table-bordered rounded shadow">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-1 text-center">Type</th>
                                    <th class="p-0 text-center">Required ?</th>
                                    <th class="text-center"><i class="text-danger bi bi-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody id="contact_form">
                                @if ($result->LandingPageFormInputs ?? '')
                                    @foreach ($result->LandingPageFormInputs as $row)
                                        <tr>
                                            <td class="p-0">
                                                <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
                                                    <option value="">-- select --</option>
                                                    <option {{ $row->input_type == 'fullname'? "selected" : '' }} value="fullname">Full Name</option>
                                                    <option {{ $row->input_type == 'email'? "selected" : '' }} value="email">Email Id</option>
                                                    <option {{ $row->input_type == 'mobile_no'? "selected" : '' }} value="mobile_no">Mobile Number</option>
                                                    <option {{ $row->input_type == 'subject'? "selected" : '' }} value="subject">Subject</option>
                                                    <option {{ $row->input_type == 'message'? "selected" : '' }} value="message">Message</option>
                                                </select>
                                            </td> 
                                            <td class="text-center p-0">
                                                <select name="form_input_required[]" id="" class="form-select form-select-sm border-0 border-bottom ">
                                                    <option value="">-- select --</option>
                                                    <option {{ $row->input_required == '1' ? "selected" : '' }} value="1">Required</option>
                                                    <option {{ $row->input_required == '0' ? "selected" : '' }} value="0">Not required</option>
                                                </select>
                                            </td>
                                            <td class="text-center"><i onclick='formDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="p-0">
                                            <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
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
                                    <tr>
                                        <td class="p-0">
                                            <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
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
                                    <tr>
                                        <td class="p-0">
                                            <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
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
                                    <tr>
                                        <td class="p-0">
                                            <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
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
                                    <tr>
                                        <td class="p-0">
                                            <select name="form_input_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
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
                                @endif
                            </tbody>
                        </table>
                    </div>
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
                            <tr>
                                <td class="p-0">
                                    <select name="media_type[]" id="" class="form-select border-0 border-bottom form-select-sm">
                                        <option value="">-- Choose --</option>
                                        <option value="Instagram">Instagram</option>
                                        <option selected value="YouTube">YouTube</option>
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
                                    <input type="url" name="link[]" id="" value="http://127.0.0.1:8000/crm" placeholder="Ex: Enter your name" class="border-0 border-bottom form-control form-control-sm">
                                </td> 
                                <td class="text-center p-0"><i onclick='socialDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @php
            // dd( $result->LandingPageMetaDetail );
        @endphp
        @include('crm.cms._meta_add_form')
    </div>
    <div class="col-md-4 stick-top h-100">
        <div class="border card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <label for="">Team Colors Settings</label>
            </div>
            <div class="card-body py-2 text-center row m-0">
                <div class="custom-form-group col my-2 p-0 me-2">
                    <input type="color" name="primary_color" class="form-control" value="{{ $result->primary_color ?? "#00BFFF" }}" required placeholder="Enter the page title">
                    <label for="" class="custom-label">Primary Color</label>
                </div> 
                <div class="custom-form-group col my-2 p-0 ms-2">
                    <input type="color" name="secondary_color" class="form-control" value="{{ $result->secondary_color ?? "#0088EA" }}" required placeholder="Enter the Primary Color">
                    <label for="" class="custom-label">Secondary Color</label>
                </div> 
            </div> 
        </div>
        
        <div class="border card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <label for="">Page Logo</label>
                <label style="font-weight: normal !important;font-size:12px !important" for="page_logo" class="btn btn-light border btn-sm "><i class="bi bi-pencil-square me-1"></i> Change Logo</label>
            </div>
            <div class="card-body py-2 text-center">
 
                @if ($result ?? '')
                    <input type="hidden" name="page_logo_data_url"  class="form-control mb-2 d-one"  value="{{ $result->page_logo  }}">
                    <input type="file" name="page_logo" id="page_logo" class="form-control mb-2 d-none" onchange="previewFile(this);" >
                @else
                    <input type="file" name="page_logo" id="page_logo" required class="form-control mb-2 d-none" onchange="previewFile(this);" >
                @endif

                <div style="width: 200px" class="border-0 mx-auto my-2">
                    <img id="page_logo_preview" height="60" class="mx-auto border-0" src="{{ $result->page_logo ?? "https://zemez.io/html/wp-content/uploads/sites/9/2018/01/logo.png" }}">
                </div>
                <b><i class="bi bi-info-circle-fill me-1"></i></b> Image height must be 60px
            </div> 
        </div>
         
        <div class="border mt-3 card">
            <div class="card-header">
                <label for="">GA Tags / Other Scripts</label>
            </div>
            <div class="card-body">
                <textarea name="other_tags" id="" class="form-control" cols="30" rows="3" placeholder="Paste here...">{{ $result->other_tags ?? "" }}</textarea>
            </div> 
        </div>
        <div class="border mt-3 card">
            <div class="card-header">
                <label for="">Iframe Embed Tags</label>
            </div>
            <div class="card-body">
                 <textarea name="iframe_tags" id="" class="form-control" cols="30" rows="6" placeholder="Paste here...">{{ $result->iframe_tags ?? "" }}</textarea>
            </div> 
        </div>
       
        <div class="border mt-3 card">
            <div class="card-header">
                <label for="">Publish</label>
            </div>
            <div class="card-body">
             
                <div class="my-1"><i class="me-2 bi bi-key-fill"></i> Status: <b>Public</b> <b>Immediately</b></div>
                <div class="my-1"><i class="me-2 bi bi-eye-fill"></i> Visibility: <b>Public</b> <b>Immediately</b></div>
                <div class="my-1"><i class="me-2 bi bi-calendar-check-fill"></i> Publish: <b>Immediately</b></div>
                @if( isset( $result->permalink ) && !empty($result->permalink))
                    <div class="my-1"><i class="me-2 bi bi-calendar-check-fill"></i> 
                        Permalink: <b>{{ route('landing.index', [$companyCode, $result->permalink]) }}</b> 
                        <span role="button" onclick="return copy_link('{{ route('landing.index', [$companyCode, $row->permalink]) }}')"> <i class="fa fa-copy"></i></span>
                    </div>
                @endif
                <div class="my-1 mt-2">
                    <input type="checkbox" name="is_default_landing_page" id="is_default_landing_page" value="1" @if(isset($result->is_default_landing_page) && $result->is_default_landing_page == 1 ) checked @endif>
                    <label for="is_default_landing_page" class="mx-2"> Make as Default Landing Page</label>
                </div>
                

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