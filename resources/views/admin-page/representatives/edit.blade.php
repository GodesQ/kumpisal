@extends('layouts.admin-layout')

@section('title', 'Representatives List')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Create Representative</div>
                <a href="{{ route('admin.representatives.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        @if (Session::get('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <form action="{{ route('admin.representative.update', $representative->id) }}" method="post">
                            @csrf
                            <div class="row border-bottom">
                                <div class="col-12">
                                    <h3 class="mb-3">Account Information</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ $representative->email }}">
                                        <span class="text-danger danger">@error('email'){{ $message }}@enderror</span>
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 border-bottom pb-2">
                                <div class="col-12">
                                    <h3 class="mb-3">General Information</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Firstname</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" name="firstname" aria-describedby="firstnameHelp" value="{{ $representative->firstname }}">
                                        <span class="danger text-danger">@error('firstname'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="middlename" class="form-label">Middlename</label>
                                        <input type="text" class="form-control" id="middlename" name="middlename" aria-describedby="middlenameHelp" value="{{ $representative->middlename }}">
                                        <span class="danger text-danger">@error('middlename'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Lastname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp" value="{{ $representative->lastname }}">
                                        <span class="danger text-danger">@error('lastname'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp" value="{{ $representative->address }}">
                                        <span class="danger text-danger">@error('address'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_admin_generated" name="is_admin_generated" value="1" checked disabled>
                                        <label class="form-label" for="is_admin_generated">
                                            Parish Representative <span style="font-size: 12px; font-weight: 400;"></span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="verify_email" name="is_verify" value="1" {{ $representative->is_verify ? 'checked' : false }}>
                                        <label class="form-label" for="verify_email">
                                            Verify Email <span style="font-size: 12px; font-weight: 400;">(If you check this box, It will not send a verification to email you registered.)</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $representative->is_active ? 'checked' : false }}>
                                        <label class="form-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 border-bottom pb-2">
                                <div class="col-12">
                                    <h3 class="mb-3">Other Information</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="years_of_service" class="form-label">Years of Service</label>
                                        <input type="number" class="form-control" id="years_of_service" name="years_of_service" aria-describedby="yearsOfServiceHelp" value="{{ $representative->representative_info->years_of_service }}">
                                        <span class="danger text-danger">@error('years_of_service'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_no" class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control" id="contact_no" name="contact_no" aria-describedby="contactNoHelp" value="{{ $representative->representative_info->contact_no }}">
                                        <span class="danger text-danger">@error('contact_no'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" aria-describedby="birthdateHelp" onchange="getAge(this)" value="{{ $representative->representative_info->birthdate }}">
                                        <span class="danger text-danger">@error('birthdate'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="age" name="age" aria-describedby="ageHelp" readonly value="{{ $representative->representative_info->age }}">
                                        <span class="danger text-danger">@error('age'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="church" class="form-label">Church</label>
                                        <select name="church" id="church" class="select2 form-select">
                                            <option value="">--- Select Church ---</option>
                                            @foreach ($churches as $church)
                                                <option value="{{ $church->id }}" {{ $representative->representative_info->church_id == $church->id ? 'selected' : false }}>{{ $church->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function getAge(e) {
            var today = new Date();
            var birthDate = new Date(e.value);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            const ageInput = document.querySelector("#age");
            ageInput.value = age;
        }
    </script>
@endpush
