@extends('layouts.admin-layout')

@section('title', 'Admins List')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Admins List</h4>
                    <a href="{{ route('admin.create') }}" class="btn btn-primary btn-block">Create</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive table-bordered data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin Name</th>
                                <th>Position</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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
                url: "{{ route('admin.admins.list') }}",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'position',
                    name: 'position',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'username',
                    name: 'username',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'role',
                    name: 'role',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],

        });

        $('.remove-btn').click(function() {
            console.log(true);
        });
    </script>
@endpush
