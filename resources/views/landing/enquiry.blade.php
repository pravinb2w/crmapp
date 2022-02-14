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
    @csrf
    {{-- <div id="error"></div> --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
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
    $("#enquiry-form").validate();
</script>