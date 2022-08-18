<form class="p-3" @submit.prevent="resetForgotPassword" >
    @csrf
    <h5 class="mb-4 text-uppercase text-center">
    Reset Password </h5>
    <div class="row">
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" id="password" :class="[password.length < 8 ? inValidClass : validClass, 'form-control']" v-model="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">New Confirm Password</label>
            <input type="password" name="password_confirmation" :class="[password_confirmation.length < 8 ? inValidClass : validClass, 'form-control']" v-model="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <input type="hidden" name="email" id="email" value="{{ $email ?? '' }}">
        <div class="text-end pt-3">
            <a href="javascript:void(0)" class="float-start mt-3" @click="switchPage('password')">Login</a>
            <button type="submit" class="btn btn-success mt-2" :disabled="(password.length >= 8 && password_confirmation.length >= 8) ? false : gotResetResponse">
                Reset Password
            </button>
        </div>
    </div> <!-- end row -->
</form>