@extends('layout_profile.layout_main')

@section('title', 'Создание нового собрания')

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <form method="POST" action="{{ route('store_meeting') }}">
        @csrf
        <div class="form-group">
            <label>Собрание</label>
            <input type="text" class="form-control" name="meeting_name" placeholder="Собрание">
        </div>
        <div class="form-group mt-3">
            <label>Описание</label>
            <input type="text" class="form-control" name="meeting_description" placeholder="Описание">
        </div>
        <div class="form-group mt-3">
            <label>Время собрания</label>
            <input class="form-control" name="date" type="datetime-local">
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        @error('any')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Создать</button>
    </form>
@endsection
