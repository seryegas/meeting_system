@extends('layout_profile.layout_main')

@section('title', 'Работа с сотрудниками: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    @if(session('user_role') > 1)
        <a type="button" class="btn btn-primary" href="{{ route('create_employee') }}">Добавить сотрудника</a>
        <a type="button" class="btn btn-secondary" href="{{ route('make_secretary') }}">Назначить секретаря</a>
    @endif
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Должность</th>
            @if(session('user_role') > 1)
                <th scope="col">Функции</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="mt-3">
                <td><a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->user_profession }}</td>
                @if(session('user_role') > 1)
                    <td><a class="btn btn-primary" href="{{ route('profile_edit', $user->id) }}" role="button">Редактировать</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
