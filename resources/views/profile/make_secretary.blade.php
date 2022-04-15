@extends('layout_profile.layout_main')

@section('title', 'Назначить секретаря: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <form method="POST" action="{{ route('store_secretary') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                Текущий секретарь
            </div>
            @if (isset($secretary))
                <div class="card-body">
                    <h5 class="card-title">ФИО: {{ $secretary->name }}</h5>
                    <p class="card-text">Профессия: {{ $secretary->user_profession }}</p>
                    <a href="{{ route('profile', $secretary->id) }}" class="btn btn-primary">Перейти к профилю</a>
                </div>
            @else
                <div class="card-body mt-1">
                    Вы до сих пор не назначили секретаря!
                </div>
            @endif

        </div>
        <div class="col-md-5 mt-4">
            <label class="form-label">Сотрудники</label>
            <select class="form-control" name="user_id">
                <option disabled selected>Выберите сотрудника</option>
                @foreach ($users as $user)
                    <option {{ $user->user_role == 3 || $user->user_role == 2  ? 'disabled' : '' 
                    }} value="{{ $user->id }}">{{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5 mt-3">
            <label class="form-label">Для подтверждения изменения введите пароль</label>
            <input type="password" class="form-control" name="password" placeholder="Введите пароль" required>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        @error('any')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Назначить сотрудника</button>
    </form>
@endsection
