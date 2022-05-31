@extends('layout_profile.layout_main')

@section('title', 'Уведомления: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <div class="row">
            <div class="col-2">
                <a type="button" class="btn btn-primary" href="{{ route('create_employee') }}">К заданиям</a>
            </div>
            <div class="col-sm-3">
                <a type="button" class="btn btn-primary" href="{{ route('meetings') }}">К собраниям</a>
            </div>
            <div class="col-sm-4">
                <form  method="POST" action="{{ route('delete_all_notes') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Очистить уведомления</button>
                </form>
            </div>
            

    </div>
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
    @if ($notes->isEmpty())
        <div class="mt-2">
            Список уведомлений пуст
        </div>
    @else
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">Тип</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Ссылка</th>
                @if(session('user_role') > 1)
                    <th class="col-md-4" scope="col">Функции</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
                @if ($note->note_status == 1)
                    <tr class="mt-3 list-group-item-primary">
                @elseif($note->note_status == 0)
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
                        <td><a href="{{ route('get_botd', $note->note_help_col) }}">Скачать повестку дня</a></td>
                    @elseif($note->note_type == 1)
                        <td><a href="{{ route('get_protocol', $note->note_help_col) }}">Скачать протокол</a></td>
                    @elseif($note->note_type == 0)
                        <td><a href="">Перейти к заданиям</a></td>
                    @endif
                    <td class="float-right">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <form  method="POST" action="{{ route('change_note_status', $note->note_id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info">Прочитано</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <form  method="POST" action="{{ route('delete_note', $note->note_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif 
@endsection
