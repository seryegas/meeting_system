@extends('layout_profile.layout_main')

@section('title', 'Дать поручение'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <form method="POST" action="{{ route('store_employee') }}">
        @csrf
        <div class="form-group">
            <label>Имя сотрудника</label>
            <input type="text" class="form-control" name="name" placeholder="Имя">
        </div>
        <div class="form-group mt-3">
            <label>Почта</label>
            <input type="email" class="form-control" name="email" placeholder="Почта">
        </div>
        <div class="form-group mt-3">
            <label>Профессия</label>
            <input type="text" class="form-control" name="profession" placeholder="Профессия">
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        @error('any')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Создать сотрудника</button>
    </form>
@endsection