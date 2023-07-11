@extends('layouts.admin-layout')

@section('title', 'Churches List')

@section('content')
    @if (Session::get('success'))
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
                    <h4 class="card-title fw-semibold">Churches List</h4>
                    @auth('admin')
                        @can('create_church')
                            <a href="{{ route('admin.church.create') }}" class="btn btn-primary btn-block">Create</a>
                        @endcan
                    @endauth
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
                                            <h6 class="fw-semibold mb-0">Parish Priest</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Diocese</h6>
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
                url: "{{ route('admin.churches.list') }}",
            },
            columns: [{
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
                    data: 'parish_priest',
                    name: 'parish_priest',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'church_diocese',
                    name: 'church_diocese',
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
            createdRow: function(row, data, dataIndex) {
                if (data.is_active == 0) {
                    $(row).css("background-color", "#E5E4E2");
                }
            },
        });

        $(document).on("click", ".remove-btn", function(e) {
            let uuid = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "Remove church from list",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.church.delete') }}",
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            uuid: uuid
                        },
                        success: function(response) {
                            if (response.status == 'DELETED') {
                                Swal.fire('Removed!', response.message, 'success').then(
                                    result => {
                                        if (result.isConfirmed) {
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
