@extends('layouts.user-layout')

@section('title', 'Church Profile')

@section('content')
    <main class="site-main" id="main">
        <div class="site-content owner-content">
            @include('user-page.representative-dashboard.representative-menu')
            <div class="container py-5">
                <div class="member-wrap">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h3>General Information</h3>
                                    <form action="{{ route('representative.church_profile.post', $user->representative_info->church->church_uuid) }}" method="POST" class="member-profile form-underline">
                                        @csrf
                                        <input type="hidden" name="current_image">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="field-input">
                                                    <label for="" class="form-label">Parish Name</label>
                                                    <input type="text" name="name" id="name" value="{{ $user->representative_info->church->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="field-input">
                                                    <label for="" class="form-label">Parish Priest</label>
                                                    <input type="text" name="parish_priest" id="parish_priest" value="{{ $user->representative_info->church->parish_priest }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="field-input">
                                                    <label for="" class="form-label">Address</label>
                                                    <input type="text" name="address" id="address" value="{{ $user->representative_info->church->address }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="field-input">
                                                    <label for="" class="form-label">Feast Date</label>
                                                    <input type="text" name="feast_date" id="feast_date" value="{{ $user->representative_info->church->feast_date }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="field-select">
                                                    <label for="criteria">Criteria</label>
                                                    <select name="criteria" id="criteria">
                                                        <option value="diocese">Diocese</option>
                                                        <option value="Vicariate">vicariate</option>
                                                    </select>
                                                    <i class="la la-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="field-input">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10">{{ $user->representative_info->church->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="field-input">
                                                    <label for="contact_no">Contact No.</label>
                                                    <input type="tel" name="contact_no" id="contact_no" value="{{ $user->representative_info->church->contact_number }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="field-input">
                                                    <label for="facebook_link">Facebook Link</label>
                                                    <input type="tel" name="facebook_link" id="facebook_link" value="{{ $user->representative_info->church->facebook_link }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="btn btn-primary">Save Church</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <h3>Church Image</h3>
                                    <img src="{{ URL::asset('admin-assets/images/churches/' . $user->representative_info->church->church_image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
