@extends('layouts.user-layout')

@section('title', 'Dashboard')

@section('content')
    <main id="main" class="site-main">
        <div class="site-content owner-content">
            @include('user-page.representative-dashboard.representative-menu')
            <div class="container">
                <div class="member-wrap">
                    @if (!auth()->user()->is_verify)
                        <div class="alert alert-danger p-2 w-100">
                            Your email has not been verified yet.
                        </div>
                    @endif
                    <div class="member-wrap-top">
                        <h2>Welcome back! {{ auth()->user()->firstname }}</h2>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center" style="font-weight: 800 !important; color: #000;">Confession
                                    Schedules</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{ route('representative.save_schedule') }}" method="POST">
                                        @csrf
                                        <div class="table-responsive">
                                            @if ($errors->any())
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <div class="alert alert-danger p-2">{{ $error }}</div>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @include('admin-page.churches.church-schedule-form.schedule-edit-form')
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-end my-4">
                                            <button class="btn btn-primary">Save Schedule</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .member-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
@endsection

@if (Session::get('login-success'))
    @push('scripts')
        <script>
            toastr.success("{{ Session::get('login-success') }}", 'Login');
        </script>
    @endpush
@endif
