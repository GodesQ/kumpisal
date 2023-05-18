@extends('layouts.admin-layout')

@section('title', 'Create Church')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title fw-semibold">Create Church</h4>
                <a href="{{ route('admin.churches.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.church.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Church Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
                                <span class="text-danger danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="parish_priest" class="form-label">Parish Priest</label>
                                <input type="text" class="form-control" id="parish_priest" name="parish_priest" aria-describedby="emailHelp">
                                <span class="text-danger danger">@error('parish_priest'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp">
                                <span class="text-danger danger">@error('address'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="feast_date" class="form-label">Feast Date</label>
                                <input type="date" class="form-control" id="feast_date" name="feast_date" aria-describedby="feastDateHelp">
                                <span class="text-danger danger">@error('feast_date'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="criteria" class="form-label">Criteria</label>
                                <select name="criteria" id="criteria" class="form-select w-100">
                                    <option value="diocese">Diocese</option>
                                    <option value="vicariate">Vicariate</option>
                                </select>
                                <span class="text-danger danger">@error('criteria'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="church_image" class="form-label">Church Image</label>
                                <input type="file" class="form-control" id="church_image" name="church_image" aria-describedby="churchImageHelp">
                                <span class="text-danger danger">@error('church_image'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Church Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                <span class="text-danger danger">@error('description'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                                <label class="form-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Save Church</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

{{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.criteria-select').select2();
        });
    </script>
@endpush --}}
