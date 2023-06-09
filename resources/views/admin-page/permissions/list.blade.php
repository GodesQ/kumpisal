@extends('layouts.admin-layout')

@section('title', 'Permission List')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="card-title fw-semibold">Permission List</h4>
                        <a href="{{ route('admin.permission.create') }}" class="btn btn-primary btn-block">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Permission</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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
                url: "{{ route('admin.permissions.list') }}",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'permission',
                    name: 'permission',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'roles',
                    name: 'roles',
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
    </script>
@endpush
