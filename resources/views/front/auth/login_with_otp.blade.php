<form class="p-3" v-on:submit="submitLoginOtp" >
    @csrf
    <h5 class="mb-4 text-uppercase text-center">
        Login using OTP  </h5>
    <div class="row">
        <div class="mb-3">
           <label for="mobile_number" class="form-label">Mobile Number</label>
           <input type="text" maxlength="10" :class="[mobile_number.length < 10 ? inValidClass : validClass, 'form-control']" v-model="mobile_number" name="mobile_number" @keypress="acceptNumber" id="mobile_number">
        </div>
       
        <div class="text-end pt-3">
           <a href="javascript:void(0)" class="float-start mt-3" @click="switchPage('password')">Signin using Password</a>
            <button type="submit" class="btn btn-success mt-2" :disabled="(mobile_number.length >= 10 && gotOtpResponse ) ? false : true">
                Send OTP
            </button>
        </div>
    </div> <!-- end row -->
</form>