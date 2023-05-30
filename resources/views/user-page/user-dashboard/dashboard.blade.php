@extends('layouts.user-layout')

@section('title', 'Dashboard')

@section('content')
<main id="main" class="site-main">
    <div class="site-content owner-content">
        @include('user-page.user-dashboard.user-menu')
        <div class="container">
            <div class="member-wrap">
                @if(!auth()->user()->is_verify)
                    <div class="alert alert-danger p-2 w-100">
                        Your email has not been verified yet.
                    </div>
                @endif
                <div class="member-wrap-top">
                    <h2>Welcome back! {{ auth()->user()->firstname }}</h2>
                </div><!-- .member-wrap-top -->
                <div class="owner-box">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div><!-- .owner-box -->
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
