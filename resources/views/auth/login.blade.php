<x-layout>
    <div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">
<div class="login-content">
<div class="login-userset">
<div class="login-logo">
<img src="assets/img/logo.png" alt="img">
</div>
<div class="login-userheading">
<h3>Sign In</h3>
<h4>Please login to your account</h4>

<x-form-error name="error" />
</div>
<form action="{{ route('login') }}" method="post">
    @csrf
<div class="form-login">
<label>Email</label>
<div class="form-addons">
<input type="text" name="email" id="email" placeholder="Enter your email address">
<img src="assets/img/icons/mail.svg" alt="img">
<x-form-error name="email" />
</div>
</div>
<div class="form-login">
<label>Password</label>
<div class="pass-group">
<input type="password" name="password" id="password" class="pass-input" placeholder="Enter your password">
<x-form-error name="password" />
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>
<div class="form-login">
<div class="alreadyuser">
</div>
</div>
<div class="form-login">
<button class="btn btn-login" type="submit"> Sign In </button>
</div>
</form>

</div>
</div>
<div class="login-img">
<img src="assets/img/login.jpg" alt="img">
</div>
</div>
</div>
</div>
</x-layout>
