<style>
    .password-btn {
        position: absolute;
        color: #000;
        font-size: 20px;
        right: 10px;
        cursor: pointer;
    }
</style>
<form action="{{ route('login.user') }}" class="form-log form-content" id="login" method="POST">
    @csrf
    <div class="field-input">
        <input type="text" placeholder="Username or Email" value="{{ old('email') }}" name="email">
        <span class="text-danger danger">
            @error('email')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="field-input" style="position: relative !important;">
        <input type="password" placeholder="Password" value="" name="password" id="password_input">
        <span class="password-btn"><i class="fa fa-eye password-btn-icon"></i></span>
        <span class="text-danger danger">
            @error('password')
                {{ $message }}
            @enderror
        </span>
    </div>
    <a title="Forgot password" class="forgot_pass" href="{{ route('user.forgot_password') }}">Forgot Password</a>
    <input type="submit" name="submit" value="Login">
</form>

@push('scripts')
    <script>
        $(document).on('click', '.password-btn', function(e) {
            let passwordInput = document.querySelector('#password_input');
            let inputType = passwordInput.getAttribute('type');

            if (inputType == 'password') {
                $('.password-btn-icon').removeClass('fa-eye');
                $('.password-btn-icon').addClass('fa-eye-slash');

            } else {
                $('.password-btn-icon').addClass('fa-eye');
                $('.password-btn-icon').removeClass('fa-eye-slash');

            }
        });
    </script>
@endpush
