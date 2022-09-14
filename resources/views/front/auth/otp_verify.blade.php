

<form class="p-3" v-on:submit="verifyOtpLogin" >
    @csrf
    <h5 class="mb-4 text-uppercase text-center">
        Login </h5>
        <div class="row">
            <input class="otp input-otp col-2" type="text" name="otp1" v-model="otp1" @keypress="acceptNumber" v-on:keyup='tabChange(1)' maxlength=1 >
            <input class="otp input-otp col-2" type="text" name="otp2" v-model="otp2" :disabled="(otp1.length > 0 ) ? false : true" @keypress="acceptNumber" v-on:keyup='tabChange(2)' maxlength=1 >
            <input class="otp input-otp col-2" type="text" name="otp3" v-model="otp3" :disabled="(otp2.length > 0 ) ? false : true" @keypress="acceptNumber"  v-on:keyup='tabChange(3)' maxlength=1 >
            <input class="otp input-otp col-2" type="text" name="otp4" v-model="otp4" :disabled="(otp3.length > 0 ) ? false : true" @keypress="acceptNumber" v-on:keyup='tabChange(4)' maxlength=1 >
            <input class="otp input-otp col-2" type="text" name="otp5" v-model="otp5" :disabled="(otp4.length > 0 ) ? false : true" @keypress="acceptNumber" v-on:keyup='tabChange(5)' maxlength=1 >
            <input class="otp input-otp col-2" type="text" name="otp6" v-model="otp6" :disabled="(otp5.length > 0 ) ? false : true" @keypress="acceptNumber"  maxlength=1 >
            <input type="hidden" name="mobile_number" v-model="mobile_number">
        </div>
    

    <div class="row text-end pt-3">
        <div class="col-lg-6 col-sm-12">
            <a href="javascript:void(0)" @click="switchPage('password')" class="float-start mt-3">Signin using passwod</a>
        </div>
        <div class="col-lg-6 col-sm-12">
            <button type="submit" class="btn btn-success mt-2" :disabled="(otp6.length > 0 && isOtpVerified ) ? false : true">
                Login
            </button>
        </div>
    </div>
</form>
