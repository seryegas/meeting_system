@extends('layout_profile.layout_main')

@section('title', 'Работа с сотрудниками: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('create_employee') }}">Добавить сотрудника</a>
    <a type="button" class="btn btn-secondary" href="{{ route('make_secretary') }}">Назначить секретаря</a>
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Должность</th>
            <th scope="col">Функции</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="mt-3">
                <td><a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->user_profession }}</td>
                <td><a class="btn btn-primary" href="{{ route('profile_edit', $user->id) }}" role="button">Редактировать</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
