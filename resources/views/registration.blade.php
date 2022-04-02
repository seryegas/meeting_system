@extends('layout')

@section('title', 'Регистрация компании')

@section('content')
<form class="row g-5 needs-validation" novalidate>
    <div class="col-md-6">
      <label for="validationCustom01" class="form-label">ФИО</label>
      <input type="text" class="form-control" id="validationCustom01" value="Иван" required>
    </div>
    <div class="col-md-5">
      <label for="validationCustom02" class="form-label">Почта</label>
      <input type="email" class="form-control" id="validationCustom02" value="example@ex.com" required>
    </div>
    <div class="col-md-5">
      <label for="validationCustom02" class="form-label">Название компании</label>
      <input type="text" class="form-control" id="validationCustom02" placeholder="Введите название" required>
    </div>
    <div class="col-md-4">
      <label for="validationCustom02" class="form-label">Почта</label>
      <input type="text" class="form-control" id="validationCustom02" value="Петров" required>
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