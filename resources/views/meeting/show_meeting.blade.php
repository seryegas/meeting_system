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
                        <a type="button" class="btn btn-success" href="{{ route('change_status', 
                        [$meeting->meeting_id, 2]) }}">Начать собрание</a>
                        <a type="button" class="btn btn-danger" href="">Отменить собрание</a>
                    @elseif($meeting->is_online == 2)
                        <p class="card-text">Стутус: идёт сейчас</p>
                        <a type="button" class="btn btn-warning" href="{{ route('change_status', 
                        [$meeting->meeting_id, 0]) }}">Закончить собрание</a>
                    @elseif($meeting->is_online == 0)
                    <p class="card-text">Стутус: окончено</p>
                        <a type="button" class="btn btn-danger" href="">В архив</a>
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
                    <th scope="col">Функции</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($questions as $question)
                    <tr class="mt-1">
                        <td class="pt-2">{{ $question->question_name }}</td>
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

