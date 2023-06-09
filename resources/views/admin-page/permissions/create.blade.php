@extends('layouts.admin-layout')

@section('title', 'Create Permission')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-title fw-semibold">Create Permission</div>
                    <a href="{{ route('admin.permissions.list') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        @push('scripts')
                            <script>
                                toastr.error("{{ $error }}", 'Failed');
                            </script>
                        @endpush
                    @endforeach
                @endif
                <form action="{{ route('admin.permission.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="permission" class="form-label">Permission</label>
                                <input type="text" class="form-control" name="permission" id="permission">
                                <sapn class="text-danger danger">@error('permission'){{ $message}}@enderror</sapn>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="roles" class="form-label">Roles</label>
                                @foreach ($roles as $role)
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{ $role->slug }}" name="roles[]" value="{{ $role->slug }}" {{ $role->slug == 'super_admin' ? 'checked readonly' : null }}>
                                            <label class="form-label" for="{{ $role->slug }}">
                                                {{ $role->role }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Save Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
