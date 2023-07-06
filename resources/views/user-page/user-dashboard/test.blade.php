@extends('layouts.user-layout')

@section('title', 'Profile')

@section('content')

<style>
    .profile-tab {
        display: none;
    }
    #profile-form.profile-tab-active {
        display: inline-block !important;
    }
    #change-password-form.profile-tab-active {
        display: inline-block !important;
    }
</style>

    <main class="main-site main" id="main-site">
        @include('user-page.user-dashboard.user-menu')
        <div class="bg-under"></div>
        <div class="main-profile-container">
            <div class="profile-menu">
                <button type="button" class="profile-menu-btn profile active">Profile</button>
                <button type="button" class="profile-menu-btn change-password">Change Password</button>
            </div>
            <div class="profile-content">
                <div id="profile-form" class="profile-tab profile-tab-active" class="member-wrap">
                    <form action="{{ route('user.profile.post', auth()->user()->user_uuid) }}" enctype="multipart/form-data"
                        method="POST" class="member-profile form-underline">
                        @csrf
                        {{-- <div class="member-avatar">
                            <img id="member_avatar" src="{{ asset('user-assets/images/member-avatar.png') }}" alt="Member Avatar">
                            <label for="upload_new">
                                <input id="upload_new" type="file" name="member_avatar" placeholder="Upload New">
                                Upload new
                            </label>

                        </div> --}}
                        <input type="hidden" name="old_user_image" id="old_user_image" value="{{ auth()->user()->user_image }}">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row">
                                    <h4 class="mb-2" style="font-size: 25px">Basic Info</h4>
                                    <div class="col-md-12">
                                        <div class="field-input">
                                            <label for="email">Email <span style="font-size: 12px;"
                                                    class="text-primary">(You can't edit your email)</span></label>
                                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                                disabled id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="field-input">
                                            <label for="firstname">First name</label>
                                            <input type="text" name="firstname" value="{{ auth()->user()->firstname }}"
                                                id="firstname">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-input">
                                            <label for="middlename">Middle name</label>
                                            <input type="text" name="middlename" value="{{ auth()->user()->middlename }}"
                                                id="middlename">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-input">
                                            <label for="lastname">Last name</label>
                                            <input type="text" name="lastname" value="{{ auth()->user()->lastname }}"
                                                id="lastname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="field-input">
                                            <label for="address">Address</label>
                                            <div class="d-flex flex-wrap">
                                                <input style="width: 85;" type="text" name="address" id="address"
                                                    value="{{ auth()->user()->address }}">
                                                {{-- <button style="width: auto;" type="button" class="btn btn-primary" id="view-map-btn">View Map<i class="ti ti-marker"></i></button> --}}
                                            </div>
                                            <input type="hidden" name="latitude" id="latitude"
                                                value="{{ auth()->user()->latitude }}">
                                            <input type="hidden" name="longitude" id="longitude"
                                                value="{{ auth()->user()->longitude }}">
                                        </div>
                                        <div class="map-container">
                                            <div class="map-content"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="address">Preferred Days</label>
                                    <?php $prefer_days = explode('|', auth()->user()->prefer_days); ?>
                                    <div class="col-md-12 mt-2">
                                        <div class="days-container">
                                            <div style="width: 25%" class="days-child">
                                                <div class="field-check">
                                                    <label for="monday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="monday"
                                                            value="monday"
                                                            {{ in_array('monday', $prefer_days) ? 'checked' : null }}>Monday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="field-check">
                                                    <label for="tuesday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="tuesday"
                                                            value="tuesday"
                                                            {{ in_array('tuesday', $prefer_days) ? 'checked' : null }}>Tuesday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="field-check">
                                                    <label for="wednesday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="wednesday"
                                                            value="wednesday"
                                                            {{ in_array('wednesday', $prefer_days) ? 'checked' : null }}>Wednesday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="field-check">
                                                    <label for="thursday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="thursday"
                                                            value="thursday"
                                                            {{ in_array('thursday', $prefer_days) ? 'checked' : null }}>Thursday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="width: 30%;" class="days-child">
                                                <div class="field-check">
                                                    <label for="friday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="friday"
                                                            value="friday"
                                                            {{ in_array('friday', $prefer_days) ? 'checked' : null }}>Friday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="field-check">
                                                    <label for="saturday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="saturday"
                                                            value="saturday"
                                                            {{ in_array('saturday', $prefer_days) ? 'checked' : null }}>Saturday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="field-check">
                                                    <label for="sunday"
                                                        style="max-width: 100% !important; flex: 1 !important;">
                                                        <input type="checkbox" name="prefer_days[]" id="sunday"
                                                            value="sunday"
                                                            {{ in_array('sunday', $prefer_days) ? 'checked' : null }}>Sunday
                                                        <span class="checkmark">
                                                            <i class="la la-check"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="profile-picture-container">
                                    @if (auth()->user()->user_image)
                                        <img src="{{ URL::asset('user-assets/images/avatars/' . auth()->user()->user_image) }}" alt="" class="profile-picture">
                                    @else
                                        <img src="{{ URL::asset('user-assets/images/avatars/default-user-image.png') }}" alt="" class="profile-picture">
                                    @endif
                                    <input type="file" hidden name="member_avatar" id="user_image_input" accept="image/*">
                                    <div class="mt-2">
                                        <button type="button" id="change-profile-btn">Upload Photo</button>
                                    </div>
                                    <div class="mt-2 text-info" style="font-size: 12px">Maximum of 1 MB*</div>
                                </div>
                            </div>
                        </div>
                        <div class="field-submit">
                            <input type="submit" value="Save Profile">
                        </div>
                    </form>
                </div>
                <div id="change-password-form" class="profile-tab">
                    <form action="{{ route('user.change_password.post', auth()->user()->user_uuid) }}" method="POST" class="member-password form-underline">
                        @csrf
                        <h4 class="mb-2" style="font-size: 25px">Change Password</h4>
                        <div class="field-input">
                            <label for="password">Current Password</label>
                            <input type="password" name="password" placeholder="Enter current password" id="old_password">
                        </div>
                        <div class="field-input">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" placeholder="Enter new password" id="new_password">
                        </div>
                        <div class="field-input">
                            <label for="re_new">Confirm Password</label>
                            <input type="password" name="confirm_password" placeholder="Enter new password" id="confirm_password">
                        </div>
                        <div class="field-check" >
                            <label for="is_logout" style="max-width: 100% !important; flex: 1 !important;">
                                <input type="checkbox" name="is_logout" id="is_logout" value="1">Logout after password change?
                                <span class="checkmark">
                                    <i class="la la-check"></i>
                                </span>
                            </label>
                        </div>
                        <div class="field-submit">
                            <input type="submit" value="Update Password">
                        </div>
                    </form><!-- .member-password -->
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        let profileMenuBtn = document.querySelectorAll('.profile-menu-btn');
        let profileTabs = document.querySelectorAll('.profile-tab');
        let changeProfileBtn = document.querySelector('#change-profile-btn');
        let userImageInput = document.querySelector('#user_image_input');

        changeProfileBtn.addEventListener('click', function(e) {
            userImageInput.click();
        });

        userImageInput.addEventListener('change', validateAndPreviewImage);

        function validateAndPreviewImage(event) {
            var input = event.target;
            var preview = document.querySelector('.profile-picture');
            var errorMessage = document.getElementById('error-message');

            if (input.files && input.files[0]) {
                var file = input.files[0];
                var fileType = file.type.split('/')[0];

                if (fileType === 'image') {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.setAttribute('src', e.target.result);
                };

                reader.readAsDataURL(file);
                errorMessage.textContent = ''; // Clear any previous error message
                } else {
                input.value = ''; // Clear the selected file
                preview.setAttribute('src', '#');
                errorMessage.textContent = 'Invalid file format. Please select an image file.';
                }
            }
        }


        profileMenuBtn.forEach((element, index) => {
            element.addEventListener('click', (e) => {
                removeProfileBtnActive();
                const clickedElement = e.target;
                clickedElement.classList.add('active');
                selectActiveTab(clickedElement);

            });
        });

        function selectActiveTab(clickedElement) {
            if(clickedElement.classList.contains('change-password')) {
                for (let index = 0; index < profileTabs.length; index++) {
                    profileTabs[index].classList.remove('profile-tab-active');
                }
                document.querySelector('#change-password-form').classList.add('profile-tab-active');
            }

            if(clickedElement.classList.contains('profile')) {
                for (let index = 0; index < profileTabs.length; index++) {
                    profileTabs[index].classList.remove('profile-tab-active');
                }
                document.querySelector('#profile-form').classList.add('profile-tab-active');
            }
        }

        function removeProfileBtnActive() {
            const btnLength = profileMenuBtn.length;
            for (let index = 0; index < btnLength; index++) {
                profileMenuBtn[index].classList.remove('active');
            }
        }
    </script>
@endpush
