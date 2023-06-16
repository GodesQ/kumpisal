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
                    <div class="row">
                        <div class="col-lg-12 col-xl-8">
                            <div class="owner-box">
                                <div class="card">
                                    <div class="card-body">
                                        @if(auth()->user()->latitude && auth()->user()->longitude)
                                            <h1 class="text-center">Churches Near You</h1>
                                        @else
                                            <h1 class="text-center">Latest Churches</h1>
                                        @endif
                                        <hr>
                                        <div class="row">
                                            @foreach ($near_churches as $church)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="card my-2">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-lg-4 d-flex align-items-start">
                                                                    <img src="{{ URL::asset('admin-assets/images/churches/' . $church->church_image) }}" alt="{{ $church->church_image }}" style="border-radius: 5px; height: 100% !important; object-fit: cover; width: 100%;">
                                                                </div>
                                                                <div class="col-xl-8 col-lg-8">
                                                                    <div class="content-con">
                                                                        <h4>{{ strlen($church->name) >= 35 ? substr($church->name, 0, 35) . '...' : $church->name }}</h4>
                                                                        <hr>
                                                                        {{-- <p>{{ substr($church->description, 0, 80) }}...</p> --}}
                                                                        <ul class="my-2">
                                                                            @if($church->distance)
                                                                                <li style="list-style: none;"><span style="font-weight: 800;">Distance</span> : {{ number_format($church->distance, 2) }} km</li>
                                                                            @else
                                                                                <li style="list-style: none;"><span style="font-weight: 800;">Priest</span> : {{ $church->parish_priest }}</li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="text-center mt-4">
                                            <a href="{{ route('churches.searchPage') }}" class="btn btn-primary">All Churches</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>Saved Churches</h1>
                                    <div class="row">
                                        @forelse (auth()->user()->saved_churches as $church)
                                            <div class="col-lg-12 ">
                                                <div class="card my-2">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-lg-4 d-flex align-items-center">
                                                                <img src="{{ URL::asset('admin-assets/images/churches/' . $church->church->church_image) }}" alt="{{ $church->church->church_image }}" style="border-radius: 5px; height: 80% !important; object-fit: cover; width: 100%;">
                                                            </div>
                                                            <div class="col-xl-8 col-lg-8">
                                                                <div class="content-con">
                                                                    <h4>{{ strlen($church->church->name) >= 35 ? substr($church->church->name, 0, 35) . '...' : $church->church->name }}</h4>
                                                                    <hr>
                                                                    {{-- <p>{{ substr($church->church->description, 0, 80) }}...</p> --}}
                                                                    <ul class="my-2">
                                                                        @if($church->church->distance)
                                                                            <li style="list-style: none;"><span style="font-weight: 800;">Distance</span> : {{ number_format($church->church->distance, 2) }} km</li>
                                                                        @else
                                                                            <li style="list-style: none;"><span style="font-weight: 800;">Priest</span> : {{ $church->church->parish_priest }}</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <h3 class="text-center">Churces Not Found</h3>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@if (Session::get('login-success'))
    @push('scripts')
        <script>
            toastr.success("{{ Session::get('login-success') }}", 'Login');
        </script>
    @endpush
@endif
