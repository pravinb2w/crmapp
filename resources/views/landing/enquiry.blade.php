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
<form id="enquiry-form" class="enquiry-form" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
    @csrf
    <div id="error"></div>
    <h3 class="h3 text-center">
        Reach us
    </h3>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="mb-2 text-start">
                <label for="fullname" class="form-label">Your Name</label>
                <input class="form-control form-control-light" type="text" id="fullname" name="fullname" placeholder="Name..." required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-2 text-start">
                <label for="emailaddress" class="form-label">Your Email</label>
                <input class="form-control form-control-light" name="email" type="email" required id="emailaddress" placeholder="Enter you email...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-2 text-start">
                <label for="subject" class="form-label">Mobile Number</label>
                <input class="form-control form-control-light" required name="mobile_no" type="text" id="mobile_no" placeholder="Enter your mobile no...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-2 text-start">
                <label for="subject" class="form-label">Subject</label>
                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-2 text-start">
                <label for="subject" class="form-label">Message</label>
                <input class="form-control form-control-light" required name="message" type="text" id="message" placeholder="Enter subject...">
            </div>
        </div>
    </div> 
    <div class="row mt-2">
        <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit">Send a Message <i
                class="mdi mdi-telegram ms-1"></i> </button>
        </div>
    </div>
</form>
