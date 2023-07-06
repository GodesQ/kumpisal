<style>
    #signup_btn[disabled] {
        background-color: lightgray !important;
        color: darkgray;
        cursor: not-allowed;
    }
</style>
<form action="{{ route('register.user') }}" class="form-sign form-content" method="POST" id="signup">
    @csrf
    <div class="field-inline">
        <div class="field-input">
            <input type="text" placeholder="First Name" value="" name="firstname">
            <span class="text-danger danger">
                @error('firstname')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="field-input">
            <input type="text" placeholder="Last Name" value="" name="lastname">
            <span class="text-danger danger">
                @error('lastname')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>
    <div class="field-input">
        <input type="email" placeholder="Email" value="" name="email">
        <span class="text-danger danger">
            @error('email')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="field-input">
        <input type="password" placeholder="Password" value="" name="password">
        <span class="text-danger danger">
            @error('password')
                {{ $message }}
            @enderror
        </span>
    </div>
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

<script>
    let accept_terms_condition_btn = document.querySelector('#accept_terms_condition');
    let signup_btn = document.querySelector('#signup_btn');

    accept_terms_condition_btn.addEventListener('change', (e) => {
        if (e.target.checked) {
            signup_btn.disabled = false;
        } else {
            signup_btn.disabled = true;
        }
    })
</script>
