@extends('layout_profile.layout_main')

@section('title', 'Профиль: ' . $user->name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <div class="mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $user->user_avatar == 1 ? asset('/storage/images/' . $user->id . '.jpg') : asset('/images/profile.jpg') }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $user->name}}</h4>
                    <p class="card-text">{{ $user->email }}</p>
                    <p class="card-text"> Профессия: {{ $user->user_profession }}</p>
                </div>
                <a class="btn btn-primary ms-3" href="{{ route('profile_edit', $user->id) }}" role="button">Редактировать</a>
            </div>  
        </div>
    </div>
@endsection
