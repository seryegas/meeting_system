@extends('layout_profile.layout_main')

@section('title', 'Собрание: ' . $meeting->meeting_name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <div class="mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $meeting->meeting_name }}</h4>
                    <p class="card-text">{{ $meeting->description }}</p>
                    <p class="card-text">Дата: {{ $meeting->meeting_time }}</p>
                    @if ($meeting->is_online == 1)
                        <p class="card-text">Стутус: предстоит</p>
                        <div><a type="button" class="btn btn-success mt-3" href="{{ route('change_status', 
                        [$meeting->meeting_id, 2]) }}">Начать собрание</a></div>
                        <div>
                            <form  method="POST" action="{{ route('delete_meeting', $meeting->meeting_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Отменить собрание</button>
                            </form>
                        </div>
                    @elseif($meeting->is_online == 2)
                        <p class="card-text">Стутус: идёт сейчас</p>
                        <a type="button" class="btn btn-warning mt-1" href="{{ route('change_status', 
                        [$meeting->meeting_id, 0]) }}">Закончить собрание</a>
                    @elseif($meeting->is_online == 0)
                    <p class="card-text">Стутус: окончено</p>
                    <div>
                        <form  method="POST" action="{{ route('delete_meeting', $meeting->meeting_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-1">Удалить собрание</button>
                        </form>
                    </div>
                    @endif
                    <a type="button" class="btn btn-secondary mt-2" href="{{ route('make_secretary') }}">Дать поручение</a>
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
                    <th scope="col">Функции</th>
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
                        <td>
                            <form method="POST" action="{{ route('delete_question', $question->question_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-1">Удалить вопрос</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    @endif
    @if ($meeting->is_online > 0)
        @include('meeting.create_question')
    @endif
@endsection

