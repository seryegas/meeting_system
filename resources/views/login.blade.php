@extends('layout')

@section('title', 'Авторизация')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="row g-5 needs-validation" novalidate>
        @csrf
        <div class="col-md-5">
            <label class="form-label">Почта</label>
            <input type="email" class="form-control" name="email" placeholder="Введите почту" required>
        </div>
        <div class="col-md-5">
            <label class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" placeholder="Введите пароль" required>
        </div>
        <a href="{{ route('login') }}" class="nav-link">Впервые на сайте? Пройдите регистрацию</a>
        <div>
            <button class="btn btn-primary" type="submit">Отправить форму</button>
        </div>
    </form>
@endsection
