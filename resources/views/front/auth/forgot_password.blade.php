<form class="p-3" v-on:submit="submitForgotPassword" method="POST">
    @csrf
    <h5 class="mb-4 text-uppercase text-center">
    Reset Password </h5>
    <div class="row">
        <div class="mb-3">
            <label for="email_id" class="form-label">Email Id</label>
            <input id="email" type="email" @blur="validateEmail" :class="[isValidEmail ? validClass : inValidClass, 'form-control' ]" @keypress="validateEmail" :class="[isValidEmail ? validClass : inValidClass, 'form-control' ]" v-model="email" name="email" required autocomplete="email" autofocus>
        </div>
    
        <div class="text-end pt-3">
            <a href="javascript:void(0)" class="float-start mt-3" @click="switchPage('password')">Cancel</a>
            <button type="submit" class="btn btn-success mt-2" :disabled="gotResponsePassword">
                Send Reset Link
            </button>
        </div>
    </div> <!-- end row -->
</form>