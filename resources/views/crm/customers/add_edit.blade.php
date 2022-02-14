<div class="modal-dialog modal-lg modal-right">
    <style>
        
#result {
  border: 1px dotted #ccc;
  padding: 3px;
}
#result ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
#result ul li {
  padding: 5px 0;
}
#result ul li:hover {
  background: #eee;
}
    </style>
    <div class="modal-content">
        <div class="modal-header px-3" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal modal-body" id="customers-form" method="POST" action="{{ route('customers.save') }}" autocomplete="off">

        <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
            <div class="w-100">
                <div class="row">
                    <div class="col-12" id="error"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3"> 
                        <label for="first_name" class="col-form-label">First Name <span class="text-danger">*</span></label>                   
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Type here.." value="" required>        
                    </div>     
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="col-form-label">Last Name  </label>                   
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Type here.." >        
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="name" class="col-form-label">Organization </label>                   
                        <input type="text" name="organization" id="organization" class="form-control" autocomplete="off">
                        <input type="hidden" name="organization_id" id="organization_id">
                        <div id="result"></div>
                    </div>
                    <div class="col-6 mb-4">
                        <label for="email" class="col-form-label"> Phone Number </label>
                        <input type="number" name="mobile_no" id="mobile_no" class="form-control" autocomplete="off">

                        {{-- <div >
                            <div id="phone-pane">
                                <div class="input-group border rounded mb-3  phone-div">
                                    <input type="number" name="mobile_no[]" class="form-control border-0 phone"placeholder="Type here.." >
                                    <button class="btn text-secondary btn-light rm-phone" type="button"><i class="mdi mdi-delete"></i></button>
                                </div>
                                <div class="input-group border rounded mb-3  phone-div">
                                    <input type="number"  name="mobile_no[]" class="form-control border-0 phone" placeholder="Type here..">
                                    <button class="btn text-secondary btn-light rm-phone" type="button"><i class="mdi mdi-delete"></i></button>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="#" class="add_phone">+ Add phone number</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-6 mb-4">
                        <label for="email" class="col-form-label"> Email Id </label>
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off">

                        {{-- <div>
                            <div id="email-pane">
                                <div class="input-group border rounded mb-3">
                                    <input type="text" name="email[]" class="form-control border-0"placeholder="Type here..">
                                    <button class="btn text-secondary btn-light rm-email" type="button"><i class="mdi mdi-delete"></i></button>
                                </div>
                                <div class="input-group border rounded mb-3">
                                    <input type="text" name="email[]" class="form-control border-0" placeholder="Type here..">
                                    <button class="btn text-secondary btn-light rm-email" type="button"><i class="mdi mdi-delete"></i></button>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="#" class="add_email">+ Add Email</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <label for="description" class="col-form-label me-2">Status</label>
                            <div>
                                <input type="checkbox" name="status" id="switch3" data-switch="primary">
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>  
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer px-3">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-primary" id="save">Save</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
        var maxField = 10; //Input fields increment limitation
        var phoneHtml = '<div class="input-group border rounded mb-3 phone-div"><input type="number" name="mobile_no[]" class="form-control border-0"placeholder="Type here.."><button class="btn text-secondary btn-light rm-phone" type="button"><i class="mdi mdi-delete"></i></button></div>';
        var x = 1;

        $('.add_phone').click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $('#phone-pane').append(phoneHtml); //Add field html
            }
        });

        $('.rm-phone').click(function(e){
            e.preventDefault();
            $(this).closest(".phone-div").remove();

            x--; //Decrement field counter
        });

        var phoneHtml = '<div class="input-group border rounded mb-3 phone-div"><input type="text" name="email[]" class="form-control border-0"placeholder="Type here.."><button class="btn text-secondary btn-light rm-phone" type="button"><i class="mdi mdi-delete"></i></button></div>';
        var x = 1;

        $('.add_email').click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $('#email-pane').append(phoneHtml); //Add field html
            }
        });

        $('.rm-email').click(function(e){
            e.preventDefault();
            $(this).closest(".email-div").remove();

            x--; //Decrement field counter
        });
        $('#result').hide();

        $('#organization').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_org') }}",
                    method:'POST',
                    data: {org:inputs},
                    success:function(response){
                        $('#result').html(response);
                        $('#result').show();
                    }      
                });
        })

        $("#customers-form").validate({
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
                            ReloadDataTableModal('customers-datatable');
                        }
                    }            
                });
            }
        });

        
</script>