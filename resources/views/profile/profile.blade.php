@extends('layout_profile.layout_main')

@section('title', 'Профиль: ' . $user->name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <div class="mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('/images/profile.jpg') }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $user->name}}</h4>
                    <p class="card-text">{{ $user->email }}</p>
                    <p class="card-text"> Профессия: {{ $user->user_profession }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
