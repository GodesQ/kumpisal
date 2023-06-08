@extends('layouts.admin-layout')

@section('title', 'Admin Log')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Staff Logs</div>
                <a href="{{ route('admin.logs.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="container">
                            <div class="header border-bottom py-2">
                                <h3>{{ $log->admin->name }}</h3>
                                <h5 class="primary text-primary">{{ $log->admin->position }}</h5>
                            </div>
                            <div class="container py-4">
                                <div class="mb-4">
                                    <h4>Log Date</h4>
                                    <h6>{{ date_format(new DateTime($log->created_at), 'F d, Y H:i A') }}</h6>
                                </div>
                                <div class="mb-4">
                                    <h4>Log Title</h4>
                                    <h6>{{ $log->title }}</h6>
                                </div>
                                <div class="mb-4">
                                    <h4>Log Type</h4>
                                    <h6>{{ $log->type }}</h6>
                                </div>
                                <div class="mb-4">
                                    <h4>Log Type ID</h4>
                                    <h6>{{ $log->type_id }}</h6>
                                </div>
                                <div class="mb-4">
                                    <h4>Log Inputs Changed</h4>
                                    <?php $inputs = explode('|', $log->inputs) ?>
                                    <ul>
                                        @foreach ($inputs as $input)
                                            <li style="font-weight: 500; font-size: 16px;" class="my-2">{{ $input }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Other logs in this TYPE ID : {{ $log->type_id }}</div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Log Date</th>
                                            <th>Title</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($other_logs as $log)
                                            <tr>
                                                <td>{{ date_format(new DateTime($log->created_at), 'F d, Y H:i A') }}</td>
                                                <td>{{ $log->title }}</td>
                                                <td>
                                                    <a href="{{ route('admin.log.show', $log->id) }}" class="btn btn-sm btn-primary"><i class="ti ti-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Other Logs Not Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
