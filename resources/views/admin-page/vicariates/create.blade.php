@extends('layouts.admin-layout')

@section('title', 'Create Vicariate')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Create Diocese</h4>
                <a href="{{ route('admin.vicariates.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <form action="{{ route('admin.vicariate.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Vicariate Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <span class="danger text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="diocese" class="form-label">Diocese</label>
                                <select name="diocese" id="diocese" class="select2 form-select">
                                    <option value="">---- Select Diocese ----</option>
                                    @forelse ($dioceses as $diocese)
                                        <option value="{{ $diocese->id }}">{{ $diocese->name }}</option>
                                    @empty
                                        <option value="">No Diocese Found</option>
                                    @endforelse
                                </select>
                                <span class="danger text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex jsutify-content-end" style="width: 100%">
                        <button class="btn btn-primary">Save Vicariate</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('stylesheets')
    <link href="{{ URL::asset('admin-assets/app-assets/css/plugins/forms/select2.css') }}" rel="stylesheet" />
@endpush
