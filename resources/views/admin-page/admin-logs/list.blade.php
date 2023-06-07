@extends('layouts.admin-layout')

@section('title', 'Admin Logs')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="card-title fw-semibold">Logs List</h4>
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
                                        <h6 class="fw-semibold mb-0">Staff Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Title</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Log Date</h6>
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
            url: "{{ route('admin.logs.list') }}",
            data: function (d) {
                    d.search = $('input[type="search"]').val()
                }
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'staff_name',
                name: 'staff_name',
                orderable: true,
                searchable: true
            },
            {
                data: 'title',
                name: 'title',
                orderable: true,
                searchable: true
            },
            {
                data: 'type',
                name: 'type',
                orderable: true,
                searchable: true
            },
            {
                data: 'log_date',
                name: 'log_date',
                orderable: true,
                searchable: true
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: true,
                searchable: true
            },
        ]
    });

    $('.remove-btn').click(function() {
        console.log(true);
    });

</script>
@endpush
