<style>
    label.error {
        color: red;
    }
    textarea.error {
        border-color: red !important;
    }
    input.error {
        border-color: red !important;
}
</style>
<form id="enquiry-form" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
    <div id="error"></div>
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="mb-2">
                <label for="fullname" class="form-label">Your Name</label>
                <input class="form-control form-control-light" type="text" id="fullname" name="fullname" placeholder="Name..." required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-2">
                <label for="emailaddress" class="form-label">Your Email</label>
                <input class="form-control form-control-light" name="email" type="email" required id="emailaddress" placeholder="Enter you email...">
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-lg-12">
            <div class="mb-2">
                <label for="subject" class="form-label">Your Subject</label>
                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-lg-12">
            <div class="mb-2">
                <label for="comments" class="form-label">Message</label>
                <textarea id="comments" rows="4" required name="message" class="form-control form-control-light" placeholder="Type your message here..."></textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit">Send a Message <i
                class="mdi mdi-telegram ms-1"></i> </button>
        </div>
    </div>
</form>

<script>
    $("#enquiry-form").validate({
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