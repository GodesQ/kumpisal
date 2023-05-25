@extends('layouts.admin-layout')

@section('title', 'Edit Church')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title fw-semibold">Edit Church</h4>
                <a href="{{ route('admin.churches.list') }}" class="btn btn-primary">Back to List</a>
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <ul class="nav nav-tabs nav-justified border-bottom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="church-tab" data-toggle="tab" href="#active" aria-controls="active" role="tab" aria-selected="true">Church</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="link-tab" data-toggle="tab" href="#link" aria-controls="link" role="tab" aria-selected="false">Schedules</a>
                    </li>
                </ul>
                <div class="tab-content px-1 pt-1 my-4">
                    <div class="tab-pane active in" id="active" aria-labelledby="church-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{ route('admin.church.update', $church->church_uuid) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="current_image" value="{{ $church->church_image }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Church Name</label>
                                                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{ $church->name }}">
                                                <span class="text-danger danger">@error('name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="parish_priest" class="form-label">Parish Priest</label>
                                                <input type="text" class="form-control" id="parish_priest" name="parish_priest" aria-describedby="emailHelp" value="{{ $church->parish_priest }}">
                                                <span class="text-danger danger">@error('parish_priest'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp" value="{{ $church->address }}">
                                                <input type="hidden" name="latitude" id="latitude" value="{{ $church->latitude }}">
                                                <input type="hidden" name="longitude" id="longitude" value="{{ $church->longitude }}">
                                                <span class="text-danger danger">@error('address'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="feast_date" class="form-label">Feast Date</label>
                                                <input type="date" class="form-control" id="feast_date" name="feast_date" aria-describedby="feastDateHelp" value="{{ $church->feast_date }}">
                                                <span class="text-danger danger">@error('feast_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="criteria" class="form-label">Criteria</label>
                                                <select name="criteria" id="criteria" class="form-select w-100">
                                                    <option {{ $church->criteria == 'diocese' ? 'selected' : null }} value="diocese">Diocese</option>
                                                    <option {{ $church->criteria == 'vicariate' ? 'selected' : null }} value="vicariate">Vicariate</option>
                                                </select>
                                                <span class="text-danger danger">@error('criteria'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="church_image" class="form-label">Change Church Image <span class="text-warning" style="font-size: 12px; font-style: italic;">(If you don't want to change current image, skip this input.)</span> </label>
                                                <input type="file" class="form-control" id="church_image" name="church_image" aria-describedby="churchImageHelp">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Church Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $church->description }}</textarea>
                                                <span class="text-danger danger">@error('description'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="contact_number" class="form-label">Contact Number</label>
                                                <input type="tel" name="contact_number" id="contact_number" class="form-control" value="{{ $church->contact_number }}">
                                                <span class="text-danger danger">@error('contact_number'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="facebook_link" class="form-label">Facebook Link</label>
                                                <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="{{ $church->facebook_link }}">
                                                <span class="text-danger danger">@error('facebook_link'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ $church->is_active ? 'checked' : null }}>
                                                <label class="form-label" for="is_active">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button class="btn btn-primary"> Save Church </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <h5>Church Image</h5>
                                <img src="{{ asset('/admin-assets/images/churches') . '/' . $church->church_image }}" alt="{{ $church->name }}" class="w-100">
                                <a href="{{ asset('/admin-assets/images/churches') . '/' . $church->church_image }}" class="btn btn-primary mt-2" target="_blank">View Full Image</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="link" aria-labelledby="link-tab" role="tabpanel"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin-assets/app-assets/css/components.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('admin-assets/app-assets/js/scripts/navs/navs.js') }}"></script>
    <script>
        function initialize() {
            let address = document.querySelector('#address');
            let latitude = document.querySelector('#latitude');
            let longitude = document.querySelector('#longitude');

            // for search
            let searchBox = new google.maps.places.SearchBox( address );

            google.maps.event.addListener( searchBox, 'places_changed', function () {
                var places = searchBox.getPlaces(), bounds = new google.maps.LatLngBounds(), i, place, lat, long, resultArray, address = places[0].formatted_address;
                lat = places[0].geometry.location.lat()
                long = places[0].geometry.location.lng();
                latitude.value = lat;
                longitude.value = long;
                resultArray =  places[0].address_components;
            });
        }

        $(document).ready(function() {
            $('#church_address').keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endpush
