<style>
    #signup_btn[disabled] {
        background-color: lightgray !important;
        color: darkgray;
        cursor: not-allowed;
    }

    .failed {
        color: rgb(233, 58, 58);
    }

    .validated {
        color: rgb(13, 129, 13);
    }
</style>
<form action="{{ route('register.user') }}" class="form-sign form-content" method="POST" id="signup">
    @csrf
    <input type="hidden" name="type_form" value="register">
    <div class="field-inline">
        <div class="field-input" style="line-height: 23px;">
            <input type="text" placeholder="First Name" value="" name="firstname">
            <span class="text-danger danger">
                @error('firstname')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="field-input" style="line-height: 23px;">
            <input type="text" placeholder="Last Name" value="" name="lastname">
            <span class="text-danger danger">
                @error('lastname')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>
    <div class="field-input" style="line-height: 23px;">
        <input type="email" placeholder="Email" value="" name="email">
        <span class="text-danger danger">
            @error('email')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="field-input" style="position: relative !important; line-height: 23px;">
        <input type="password" placeholder="Password" value="" id="register_input_password" name="password"
            style="margin-bottom: 10px !important; ">
        <span class="password-btn"><i class="fa fa-eye password-btn-icon"></i></span>
        <ul style="margin-left: 20px; margin-bottom: 20px;">
            <li style="height: 30px;" id="password-validation-one" class="password-validation">Atleast 8 characters</li>
            <li style="height: 30px;" id="password-validation-two" class="password-validation">Atleast 1 capital letter
            </li>
            <li style="height: 30px;" id="password-validation-three" class="password-validation">Atleast 1 number or
                symbol</li>
        </ul>
    </div>
    <span class="text-danger danger">
        @error('password')
            {{ $message }}
        @enderror
    </span>
    <div class="field-check">
        <label for="accept_terms_condition">
            <input type="checkbox" id="accept_terms_condition" value="1" name="accept_terms_condition">
            Accept the <a title="Terms" href="#">Terms</a> and <a title="Privacy Policy" href="#">Privacy
                Policy</a>
            <span class="checkmark">
                <i class="la la-check"></i>
            </span>
        </label>
    </div>
    <input type="submit" name="submit" value="Sign Up" id="signup_btn" disabled>
</form>

@push('scripts')

    <script>
        let accept_terms_condition_btn = document.getElementById('accept_terms_condition');
        let signup_btn = document.getElementById('signup_btn');
        let passwordValidatorOne = document.getElementById('password-validation-one');
        let passwordValidatorTwo = document.getElementById('password-validation-two');
        let passwordValidatorThree = document.getElementById('password-validation-three');
        let passwordValidators = document.querySelectorAll('.password-validation');

        accept_terms_condition_btn.addEventListener('change', (e) => {
            signup_btn.disabled = !(e.target.checked && passwordValidate());
        });

        document.getElementById('register_input_password').addEventListener('input', function(event) {
            let password = event.target.value;

            // Regular expression pattern for validation
            let passwordPattern = /^(?=.*[A-Z])(?=.*[0-9\W]).{8,}$/;

            // Reset the classes for all validation elements
            passwordValidators.forEach(validator => {
                validator.classList.remove('failed', 'validated');
            });

            if (!passwordPattern.test(password)) {

                // Password does not meet the requirements
                if (password.length < 8) {
                    passwordValidatorOne.classList.add('failed');
                } else {
                    passwordValidatorOne.classList.add('validated');
                }

                if (!/[A-Z]/.test(password)) {
                    passwordValidatorTwo.classList.add('failed');
                } else {
                    passwordValidatorTwo.classList.add('validated');
                }

                if (!/[0-9\W]/.test(password)) {
                    passwordValidatorThree.classList.add('failed');
                } else {
                    passwordValidatorThree.classList.add('validated');
                }
            } else {
                // Password meets the requirements
                passwordValidators.forEach(validator => {
                    validator.classList.add('validated');
                });
            }

            signup_btn.disabled = !(accept_terms_condition_btn.checked && passwordValidate());
        });

        function passwordValidate() {
            return !Array.prototype.some.call(passwordValidators, validator => {
                return validator.classList.contains('failed') || !validator.classList.contains('validated');
            });
        }

        $(document).on('click', '.password-btn', function(e) {
            let passwordInput = document.querySelector('#register_input_password');
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
