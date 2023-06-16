<form action="{{ route('login.user') }}" class="form-log form-content" id="login" method="POST">
    @csrf
    <div class="field-input">
        <input type="text" placeholder="Username or Email" value="{{ old('email') }}" name="email">
        <span class="text-danger danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="field-input">
        <input type="password" placeholder="Password" value="" name="password">
        <span class="text-danger danger">@error('password'){{ $message }}@enderror</span>
    </div>
    <a title="Forgot password" class="forgot_pass" href="{{ route('user.forgot_password') }}">Forgot Password</a>
    <input type="submit" name="submit" value="Login">
</form>
