@extends('layouts.admin-layout')

@section('title', 'Users')

@section('content')

    @if(Session::get('success'))
        @push('scripts')
            <script>
                toastr.success("{{ Session::get('success') }}", 'Success')
            </script>
        @endpush
    @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Users List</h4>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-block">Create</a>
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
                                            <h6 class="fw-semibold mb-0">Name</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Email</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Email Verification</h6>
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
                url: "{{ route('admin.users.list') }}",
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
                    data: 'email',
                    name: 'email',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'verified',
                    name: 'verified',
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

        $(document).on("click", ".remove-btn", function (e) {
            let uuid = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "Remove user from list",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.user.delete') }}",
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            user_uuid: uuid
                        },
                        success: function(response) {
                            if(response.status == 'Removed') {
                                Swal.fire('Removed!',response.message, 'success').then(result => {
                                    if(result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }
                        }
                    })
                }
            })
        });

    </script>
@endpush
