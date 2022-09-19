<form class="p-3" v-on:submit="submitLoginPassword" >
    @csrf
    <h5 class="mb-4 text-uppercase text-center">
        Login </h5>
    <div class="row">
        <div class="mb-3">
            <label for="email_id" class="form-label">Email Id</label>
            <input id="email" type="email" @blur="validateEmail" :class="[isValidEmail ? validClass : inValidClass, 'form-control' ]" @keypress="validateEmail" :class="[isValidEmail ? validClass : inValidClass, 'form-control' ]" v-model="email" name="email" required autocomplete="email" autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label w-100">Password
                <a href="javascript:void(0)" class="float-end" @click="switchPage('reset')" > Forgot Password </a>
            </label>
            <input id="password" type="password" :class="[password.length < 8 ? inValidClass : validClass, 'form-control']" v-model="password"  name="password" required >

        </div>
       
        <div class="text-end pt-3">
            <a href="javascript:void(0)" @click="switchPage('otp')" class="float-start mt-3">Signin using OTP</a>
            <button type="submit" class="btn btn-success mt-2">
                Login
            </button>
        </div>
    </div> <!-- end row -->
</form>