@extends('layouts.admin-layout')

@section('title', 'MESSAGE')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {{ $message->message }}
            </div>
        </div>
    </div>
@endsection
