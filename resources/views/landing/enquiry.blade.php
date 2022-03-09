<form id="enquiry-form" class="enquiry-form p-0" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
    @csrf
    <div id="error"></div>
    <div class="row m-0 ">
        @if ($result->LandingPageFormInputs)
            @foreach ($result->LandingPageFormInputs as $input)
                <div class="col-lg-12 mb-3">
                    <div class="text-start position-relative">
                        <input class="form-control rounded-pill" required name="subject" type="{{ $input->input_type }}" id="subject" placeholder="Enter {{ $input->input_text }}..." {{ $input->input_required }}>
                    </div>
                </div>
            @endforeach
        @endif
        {{-- <div class="col-lg-12">
            <div class="text-start position-relative">
                <small for="fullname" class="form-label text-white m-0">Your Name</small>
                <input class="form-control " type="text" id="fullname" name="fullname" placeholder="Name..." required>
            </div>
        </div>--}}
        <div class="col-12">
            <button class="btn btn-primary p-1 rounded-pill" type="submit">Send a Message <i
                class="mdi mdi-telegram ms-1"></i> </button>
        </div>
    </div>
</form>
