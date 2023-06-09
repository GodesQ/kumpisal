@extends('layouts.admin-layout')

@section('title', 'Roles')

@section('content')
    @if (Session::get('success'))
        @push('scripts')
            <script>
                toastr.success('{{ Session::get("sucess") }}', 'Success')
            </script>
        @endpush
    @endif
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Roles List</h4>
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-block">Create</a>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Role</th>
                                        <th>Slug</th>
                                        <th>Action</th>
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
                url: "{{ route('admin.roles.list') }}",
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'role',
                    name: 'role',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'slug',
                    name: 'slug',
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

