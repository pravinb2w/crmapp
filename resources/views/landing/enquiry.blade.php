<style>
    
.loader {
  width: 60px;
  position: absolute;
z-index: 9;
top: 55%;
left: 33%;
}

.loader-wheel {
  animation: spin 1s infinite linear;
  border: 2px solid rgba(30, 30, 30, 0.5);
  border-left: 4px solid #fff;
  border-radius: 50%;
  height: 50px;
  margin-bottom: 10px;
  width: 50px;
}

.loader-text {
  color: #fff;
  font-family: arial, sans-serif;
}

.loader-text:after {
  content: 'Loading';
  animation: load 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes load {
  0% {
    content: 'Loading';
  }
  33% {
    content: 'Loading.';
  }
  67% {
    content: 'Loading..';
  }
  100% {
    content: 'Loading...';
  }
}
</style>
<form id="enquiry-form" class="enquiry-form p-0" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
    <div class="loader" style="display: none;">
        <div class="loader-wheel"></div>
        <div class="loader-text"></div>
    </div>
    @csrf
    <div id="error"></div>
    <div class="row m-0 ">
        @if ($result->LandingPageFormInputs)
            @foreach ($result->LandingPageFormInputs as $input)
                <div class="col-lg-12 mb-3">
                    <div class="text-start position-relative">
                        <input class="form-control rounded-pill" required name="{{ $input->input_type }}" 
                        type="{{ $input->input_type ===  'fullname' ? 'text' : ''}}{{ $input->input_type ===  'email' ? 'email' : ''}}{{ $input->input_type ===  'mobile_no' ? 'number' : ''}}{{ $input->input_type ===  'subject' ? 'text' : ''}}{{ $input->input_type ===  'message' ? 'text' : ''}}"                         id="subject" 
                        placeholder="{{ $input->input_type ===  'fullname' ? 'Enter Your Full Name' : ''}}{{ $input->input_type ===  'email' ? 'Enter Your Email Id' : ''}}{{ $input->input_type ===  'mobile_no' ? 'Enter Your Contact Number' : ''}}{{ $input->input_type ===  'subject' ? 'Enter  Your Subject' : ''}}{{ $input->input_type ===  'message' ? 'Enter Your Message...' : ''}}" {{ $input->input_required }}>
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
            <button class="btn btn-primary p-1 rounded-pill" type="submit" id="send_msg">Send a Message <i
                class="mdi mdi-telegram ms-1"></i> </button>
        </div>
    </div>
</form>
