@extends('layouts.admin-layout')

@section('title', 'Create Schedule')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title fw-semibold">Create Schedule</h4>
                <a href="{{ route('admin.confession_schedules.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.confession_schedule.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Church Name</label>
                                <select name="church_uuid" id="church_uuid" class="form-control select2">
                                    @foreach ($churches as $church)
                                        <option value="{{ $church->church_uuid }}">{{ $church->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="schedule_date" class="form-label">Schedule Date</label>
                                <input type="date" class="form-control" id="schedule_date" name="schedule_date" aria-describedby="scheduleDateHelp">
                                <span class="text-danger danger">@error('schedule_date'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="started_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="started_time" name="started_time" aria-describedby="startedTimeHelp">
                                <span class="text-danger danger">@error('started_time'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" aria-describedby="endTimeHelp">
                                <span class="text-danger danger">@error('end_time'){{ $message }}@enderror</span>
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
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/selects/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin-assets/js/selects/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/selects/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
