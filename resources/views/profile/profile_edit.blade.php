@extends('layout_profile.layout_main')

@section('title', 'Редактирование профиля: ' . $user->name)

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <div class="mb-3" style="max-width: 800px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{$user->user_avatar == 1 ? asset('/storage/images/' . $user->id . '.jpg') : asset('/images/profile.jpg') }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8 ">
                <form class="ms-3" method="POST" action="{{ route('update_user') }}" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Имя сотрудника</label>
                        <input type="text" class="form-control" name="name" value=
                        "{{ isset($user) ? $user->name : 'Фамилия Имя Отчество'}}">
                    </div>
                    <div class="form-group mt-3">
                        <label>Почта</label>
                        <input type="email" class="form-control" name="email" value=
                        "{{ isset($user) ? $user->email : 'Почта'}}">
                    </div>
                    <div class="form-group mt-3">
                        <label>Профессия</label>
                        <input type="text" class="form-control" name="profession" value=
                        "{{ isset($user) ? $user->user_profession : 'Профессия'}}">
                    </div>
                    <div class="form-group mt-3">
                        <input type="hidden" class="form-control" name="id" value=
                        "{{ isset($user) ? $user->id : 0}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="formFileLg" class="form-label">Загрузить новое фото профиля</label>
                        <input class="form-control form-control-lg" name="image" type="file">
                      </div>
                    @error('any')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-3">Редактировать данные</button>
                </form>
                @if ($user->id != session('user_id') && session('user_role') == 3)
                    <div class="mt-3">
                        <a type="button" class="btn btn-secondary" href="{{ route('new_password', $user->id) }}">Генерация нового пароля</a>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection