@extends('layouts.admin-layout')

@section('title', 'Vicariates')

@section('content')
    @if (Session::get('success'))
        @push('scripts')
            <script>
                toastr.success("{{ Session::get('success') }}", 'Success', 'positionclass = "toast-bottom-full-width"')
            </script>
        @endpush
    @endif
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Vicariates List</h4>
                    <a href="{{ route('admin.vicariate.create') }}" class="btn btn-primary btn-block">Create</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Diocese</th>
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
                url: '{{ route('admin.vicariates.list') }}'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'church_diocese',
                    name: 'church_diocese'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        })
    </script>
@endpush
