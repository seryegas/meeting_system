@extends('layout_profile.layout_main')

@section('title', 'Вопрос: ' . $question->question_name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <form class="ms-3" method="POST" action="{{ route('update_question') }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Описание</label>
            <textarea type="text" class="form-control" name="description">{{$question->description}}</textarea>
        </div>
        <div class="form-group mt-3">
            <input type="hidden" class="form-control" name="question_id" value="{{ isset($question) ? $question->question_id : 0 }}">
        </div>
        @error('any')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Редактировать данные</button>
    </form>
@endsection
