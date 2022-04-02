@extends('layout')

@section('title', 'Регистрация компании')

@section('content')
<form method="POST" action="/reg" class="row g-5 needs-validation" novalidate>
    @csrf
    <div class="col-md-6">
      <label class="form-label">ФИО</label>
      <input type="text" class="form-control" name="user_name" placeholder="Введите имя" required>
    </div>
    <div class="col-md-5">
      <label class="form-label">Почта</label>
      <input type="email" class="form-control" name="email" placeholder="Введите почту" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Название компании</label>
      <input type="text" class="form-control" name="company_name" placeholder="Введите название" required>
    </div>
    <div class="col-md-5">
      <label class="form-label">Область деятельности</label>
      <select class="form-control" name="industry_type">
        <option disabled selected>Выберите тип компании</option>
        @foreach($industryList as $industry)
          <option value="{{ $industry->industry_id }}">{{ $industry->industry_name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Примите условия и соглашения
        </label>
        <div class="invalid-feedback">
          Вы должны принять перед отправкой.
        </div>
      </div>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Отправить форму</button>
    </div>
  </form>  
@endsection