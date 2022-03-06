<form id="enquiry-form" class="enquiry-form p-0" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
    @csrf
    <div id="error"></div>
    <div class="row m-0 ">
        <div class="col-lg-12">
            <div class="text-start position-relative">
                <small for="fullname" class="form-label text-white m-0">Your Name</small>
                <input class="form-control " type="text" id="fullname" name="fullname" placeholder="Name..." required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-start position-relative">
                <small for="emailaddress" class="form-label text-white m-0">Your Email</small>
                <input class="form-control " name="email" type="email" required id="emailaddress" placeholder="Enter you email...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-start position-relative">
                <small for="subject" class="form-label text-white m-0">Mobile Number</small>
                <input class="form-control " required name="mobile_no" type="text" id="mobile_no" placeholder="Enter your mobile no...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-start position-relative">
                <small for="subject" class="form-label text-white m-0">Subject</small>
                <input class="form-control " required name="subject" type="text" id="subject" placeholder="Enter subject...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-start position-relative">
                <small for="subject" class="form-label text-white m-0">Message</small>
                <input class="form-control " required name="message" type="text" id="message" placeholder="Enter here..">
            </div>
        </div>
        <div class="col-12  mt-3">
            <button class="btn btn-primary p-3 py-2 rounded-pill" type="submit">Send a Message <i
                class="mdi mdi-telegram ms-1"></i> </button>
        </div>
    </div>
</form>
