@extends('layouts.admin-layout')

@section('title', 'Edit Diocese')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Edit Diocese</h4>
                    <a href="{{ route('admin.dioceses.list') }}" class="btn btn-primary btn-block">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <form action="{{ route('admin.diocese.update', $diocese->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Diocese Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $diocese->name }}">
                                <span class="danger text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area" class="form-label">Area</label>
                                <select name="area" id="area" class="form-select">
                                    <option value="Luzon" {{ $diocese->area == 'Luzon' ? 'selected' : null }}>Luzon</option>
                                    <option value="Visayas" {{ $diocese->area == 'Visayas' ? 'selected' : null }}>Visayas</option>
                                    <option value="Mindanao" {{ $diocese->area == 'Mindanao' ? 'selected' : null }}>Mindanao</option>
                                </select>
                                <span class="danger text-danger">@error('area'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bishop" class="form-label">Bishop</label>
                                <input type="text" class="form-control" name="bishop" id="bishop" value="{{ $diocese->bishop }}">
                                <span class="danger text-danger">@error('bishop'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $diocese->address }}">
                                <span class="danger text-danger">@error('address'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="contact_no" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contact_no" id="contact_no" value="{{ $diocese->contact_no }}">
                                <span class="danger text-danger">@error('contact_no'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="vicar_general" class="form-label">Vicar General</label>
                                <input type="text" class="form-control" name="vicar_general" id="vicar_general" value="{{ $diocese->vicar_general }}">
                                <span class="danger text-danger">@error('vicar_general'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="chancellor" class="form-label">Chancellor</label>
                                <input type="text" class="form-control" name="chancellor" id="chancellor" value="{{ $diocese->chancellor }}">
                                <span class="danger text-danger">@error('chancellor'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Update Diocese</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
