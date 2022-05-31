@extends('layout_profile.layout_main')

@section('title', 'Уведомления: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    @if(session('user_role') > 1)
        <a type="button" class="btn btn-primary" href="{{ route('create_employee') }}">К заданиям</a>
    @endif
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">Тип</th>
            <th scope="col">Сообщение</th>
            <th scope="col">Отличие</th>
            @if(session('user_role') > 1)
                <th scope="col">Функции</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            @if ($note->note_status == 0)
                <tr class="mt-3 list-group-item-primary">
            @elseif($note->note_status == 1)
                <tr class="mt-3 list-group-item-secondary">
            @endif
                @if($note->note_type == 0)
                    <td>Новое собрание</td>
                @elseif($note->note_type == 1)
                    <td>Собрание завершено</td>
                @elseif($note->note_type == 0)
                    <td>У вас новое поручение!</td>
                @endif
                <td style="word-wrap: break-word;
                    max-width: 200px;">{{ $note->note_text }}</td>
                @if($note->note_type == 0)
                    <td><a href="">Скачать повестку дня</a></td>
                @elseif($note->note_type == 1)
                    <td><a href="">Скачать протокол</a></td>
                @elseif($note->note_type == 0)
                    <td><a href="">Перейти к заданиям</a></td>
                @endif
                <td class="float-right">
                    <a class="btn btn-info" href="" role="button">Прочитано</a>
                    <a class="btn btn-danger" href="" role="button">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
