<style>
    .password-btn {
        position: absolute;
        color: #000;
        font-size: 20px;
        right: 10px;
        cursor: pointer;
    }
</style>
<form action="{{ route('login.user') }}" class="form-log form-content" id="login" method="POST" style="line-height: 23px;">
    @csrf
    <input type="hidden" name="type_form" value="login">
    <div class="field-input">
        <input type="text" placeholder="Username or Email" value="{{ old('email') }}" name="email"  style="margin-bottom: 15px !important;">
        <span class="text-danger danger">
            @error('email')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="field-input" style="position: relative !important;">
        <input type="password" placeholder="Password" value="" name="password" id="input_password" style="margin-bottom: 15px !important;">
        <span class="password-btn"><i class="fa fa-eye password-btn-icon"></i></span>
    </div>
    <span class="text-danger danger">
        @error('password')
            {{ $message }}
        @enderror
    </span>
    <a title="Forgot password" class="forgot_pass" href="{{ route('user.forgot_password') }}">Forgot Password</a>
    <input type="submit" name="submit" value="Login">
</form>

@push('scripts')
    <script>
        $(document).on('click', '.password-btn', function(e) {
            let passwordInput = document.querySelector('#input_password');
            let inputType = passwordInput.type;

            if (inputType == 'password') {
                $('.password-btn-icon').removeClass('fa-eye');
                $('.password-btn-icon').addClass('fa-eye-slash');
                passwordInput.type = 'text';
            } else {
                $('.password-btn-icon').addClass('fa-eye');
                $('.password-btn-icon').removeClass('fa-eye-slash');
                passwordInput.type = 'password';
            }
        });
    </script>
@endpush
