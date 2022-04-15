@extends('layout_profile.layout_main')

@section('title', 'Компания: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <div>
        <h3>Название компании: {{ $company->company_name }}</h3>
    </div>
    <div>
        <h3>Отрасль компании: {{ $industry_type->industry_name }}</h3>
    </div>
    <div>
        <h3>Председатель: <a href="{{ route('profile', $supervisor->id) }}">{{ $supervisor->name }}</a></h3>
    </div>
    <div>
        <h3>Секретарь: 
        @if(isset($secretary))
            <a href="{{ route('profile', $secretary->id) }}">{{ $secretary->name }}</a>
        @else
            Ещё не назначили
        @endif
        </h3>

    </div>
@endsection