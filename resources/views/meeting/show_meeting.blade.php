@extends('layout_profile.layout_main')

@section('title', 'Собрание: ' . $meeting->meeting_name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <a class="btn btn-info ms-3 mb-2" href="{{ route('meetings') }}" role="button">Назад к списку собраний</a>
    <div class="mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $meeting->meeting_name }}</h4>
                    <p class="card-text">{{ $meeting->description }}</p>
                    <p class="card-text">Дата: {{ $meeting->meeting_time }}</p>
                    @if ($meeting->is_online == 1)
                        <p class="card-text">Статус: описывается</p>
                        @if(session('user_role') > 1)
                            <div><a type="button" class="btn btn-success mt-3" href="{{ route('change_status', 
                            [$meeting->meeting_id, 3]) }}">Объявить собрание (повестка дня готова)</a></div>
                            <div>
                                <form  method="POST" action="{{ route('delete_meeting', $meeting->meeting_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2">Отменить собрание</button>
                                </form>
                            </div>
                        @endif
                    @elseif ($meeting->is_online == 3)
                        <p class="card-text">Статус: предстоит</p>
                        @if(session('user_role') > 1)
                            <div><a type="button" class="btn btn-success mt-3" href="{{ route('change_status', 
                            [$meeting->meeting_id, 2]) }}">Начать собрание</a></div>
                            <div>
                                <form  method="POST" action="{{ route('delete_meeting', $meeting->meeting_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2">Отменить собрание</button>
                                </form>
                            </div>
                        @endif
                    @elseif($meeting->is_online == 2)
                        <p class="card-text">Статус: идёт сейчас</p>
                        @if(session('user_role') > 1)
                            <a type="button" class="btn btn-warning mt-1" href="{{ route('change_status', 
                            [$meeting->meeting_id, 0]) }}">Закончить собрание</a>
                        @endif
                    @elseif($meeting->is_online == 0)
                    <p class="card-text">Статус: окончено</p>
                    @if(session('user_role') > 1)
                        <div>
                            <form  method="POST" action="{{ route('delete_meeting', $meeting->meeting_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить собрание</button>
                            </form>
                        </div>
                        <div class="mt-2">
                            <a type="button" class="btn btn-secondary" href="{{ route('create_task') }}">Дать поручение</a>
                        </div>
                    @endif
                    <div class="mt-2">
                        <a class="btn btn-info" href="{{ route('get_protocol', 
                            $meeting->meeting_id) }}" role="button">Скачать протокол</a>
                    </div>
                    @endif
                </div>
            </div>  
        </div>
    </div>
    @if ($questions->isEmpty())
        <h4 class="mt-3">Добавьте хотябы 1 вопрос!</h4>
    @else
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Название</th>
                    @if(session('user_role') > 1)
                        <th scope="col">Функции</th>
                    @endif
                </tr>
            </thead>
            <tbody>

                @foreach ($questions as $question)
                    <tr class="mt-1">
                        <td class="pt-2"><a href="{{ route('show_question', $question->question_id) }}">{{ $question->question_name }}</a>
                            <div class="mt-3">
                                Докладчик: {{$question->users->name}}
                            </div>
                        </td>
                        @if(session('user_role') > 1)
                            <td>
                                <form method="POST" action="{{ route('delete_question', $question->question_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-1">Удалить вопрос</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach

            </tbody>

        </table>
    @endif
    @if ($meeting->is_online > 0)
        @include('meeting.create_question')
    @endif
@endsection

