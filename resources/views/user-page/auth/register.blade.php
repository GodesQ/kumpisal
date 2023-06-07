<form action="{{ route('register.user') }}" class="form-sign form-content" method="POST" id="signup">
    @csrf
    <div class="field-inline">
        <div class="field-input">
            <input type="text" placeholder="First Name" value="" name="firstname">
            <span class="text-danger danger">@error('firstname'){{ $message }}@enderror</span>
        </div>
        <div class="field-input">
            <input type="text" placeholder="Last Name" value="" name="lastname">
            <span class="text-danger danger">@error('lastname'){{ $message }}@enderror</span>
        </div>
    </div>
    <div class="field-input">
        <input type="email" placeholder="Email" value="" name="email">
        <span class="text-danger danger">@error('email'){{ $message }}@enderror</span>
    </div>
    <div class="field-input">
        <input type="password" placeholder="Password" value="" name="password">
        <span class="text-danger danger">@error('password'){{ $message }}@enderror</span>
    </div>
    <div class="field-check">
        <label for="accept">
            <input type="checkbox" id="accept" value="1" name="accept_terms_condition">
            Accept the <a title="Terms" href="#">Terms</a> and <a title="Privacy Policy" href="#">Privacy Policy</a>
            <span class="checkmark">
                <i class="la la-check"></i>
            </span>
        </label>
    </div>
    <input type="submit" name="submit" value="Sign Up">
</form>
