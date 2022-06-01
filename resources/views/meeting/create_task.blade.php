@extends('layout_profile.layout_main')

@section('title', 'Создание нового поручения')

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <form method="POST" action="{{ route('store_task')}}" enctype="multipart/form-data">
        @csrf
        <label class="form-label">Сотрудники</label>
            <select class="form-control" name="user_id">
                <option disabled selected>Выберите сотрудника</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}
                    </option>
                @endforeach
            </select>
        <div class="form-group mt-3">
            <label>Опишите суть задачи</label>
            <input type="text" class="form-control" name="task_text" placeholder="Задача">
        </div>
        <div class="form-group mt-3">
            <label for="formFileLg" class="form-label">Добавить файл с дополнительной информацей. Формат docx или pdf.</label>
            <input class="form-control form-control-lg" name="help_file" type="file">
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        @error('any')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Создать</button>
    </form>
@endsection
