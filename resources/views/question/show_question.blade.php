@extends('layout_profile.layout_main')

@section('title', 'Вопрос: ' . $question->question_name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <a class="btn btn-info ms-3 mb-2" href="{{ route('show_meeting', $meeting->meeting_id) }}" role="button">Назад к собранию</a>
    <form class="ms-3" method="POST" action="{{ route('update_question') }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Описание</label>
            @if(session('user_role') > 1)
                <textarea type="text" class="form-control" name="description">{{$question->description}}</textarea>
            @else
                <p class="form-control">
                    {{$question->description}}
                </p>
            @endif
        </div>
        <div class="form-group mt-3">
            <input type="hidden" class="form-control" name="question_id" value="{{ isset($question) ? $question->question_id : 0 }}">
        </div>
        @error('any')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        @if(session('user_role') > 1)
            <button type="submit" class="btn btn-primary mt-3">Редактировать данные</button>
        @endif
    </form>
    @foreach($solutions as $solution)
    <div>
        <div class="mt-3 ms-3">
            РЕШИЛИ: {{$solution->solution_desc}}
        </div>
        @if(session('user_role') > 1)
            <form class="ms-3 float-right" method="POST" action="{{ route('delete_solution', $solution->solution_id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-1">Удалить решение</button>
            </form>
        @endif
    </div>
    @endforeach
    @if(session('user_role') > 1)
        @include('question.solution')
    @endif
@endsection
