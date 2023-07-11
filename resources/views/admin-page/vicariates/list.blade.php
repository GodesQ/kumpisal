@extends('layouts.admin-layout')

@section('title', 'Vicariates')

@section('title')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title fw-semibold">Vicariates List</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap data-table mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Diocese</th>
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
