@extends('layouts.admin-layout')

@section('title', 'Confession Schedules')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Schedules List</h4>
                    <a href="{{ route('admin.confession_schedule.create') }}" class="btn btn-primary btn-block">Create</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle data-table">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0" width="50">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Church Name</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Schedule Date</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Start Time</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">End Time</h6>
                                        </th>
                                        <th class="border-bottom-0" width="100">
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
         let table = $('.data-table').DataTable({
            processing: true,
            pageLength: 25,
            responsive: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.confession_schedules.list') }}",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'church_name',
                    name: 'church_name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'schedule_date',
                    name: 'schedule_date',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'started_time',
                    name: 'started_time',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'end_time',
                    name: 'end_time',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    </script>
@endpush
