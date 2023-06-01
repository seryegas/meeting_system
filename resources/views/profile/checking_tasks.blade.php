@extends('layout_profile.layout_main')

@section('title', 'Задания: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
    @if ($tasks_on_check->isEmpty())
    <div class="mt-2 ms-3">
        <h4>Нет задач на проверке</h4>
        <div class="line"></div>
    </div>
    @else
        <div class="container-fluid"><h3>Ваши задачи на проверке</h3>
            <table id="productSizes" class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-3">ФИО</th>
                        <th class="col-4">Задание</th>
                        <th class="col-4">Подтвердить выполнение</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks_on_check as $task)
                        <tr class="d-flex table-primary">
                            <td class="col-3">{{ $task->users->name }}</td>
                            <td class="col-4">{{ $task->task_text }}</td>
                            <td class="col-4">
                                <form  method="POST" action="{{ route('accept_task', ['id' => $task->task_id, 'type' => 3]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Отправить на доработку</button>
                                </form>
                                <form  method="POST" action="{{ route('close_task', $task->task_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning">Принять задачу</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection