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
    @if ($tasks_new->isEmpty())
    <div class="mt-2 ms-3">
        <h4>У вас нет новых задач</h4>
        <div class="line"></div>
    </div>
    @else
        <div class="container-fluid"><h3>Новые задачи</h3>
            <table id="productSizes" class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-9">Задание</th>
                        <th class="col-3">Доп. информация</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks_new as $task)
                        <tr class="d-flex table-primary">
                            <td class="col-9">{{ $task->task_text }}</td>
                            @if($task->has_file == 0)
                                <td class="col-3">
                                    <form  method="POST" action="{{ route('accept_task', ['id' => $task->task_id, 'type' => 1]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info">Принять</button>
                                    </form>
                                </td>
                            @else
                                <td class="col-3">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <form  method="POST" action="{{ route('accept_task', ['id' => $task->task_id, 'type' => 1]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info">Принять</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <a type="button" class="btn btn-primary" href="{{ route('get_task_help_file', $task->task_id) }}">Скачать</a>
                                            </div>
                                        </div>
                                    </div>                                 
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($tasks_accepted->isEmpty())
    <div class="mt-2 ms-3">
        <h4>У вас нет принятых задач</h4>
        <div class="line"></div>
    </div>
    @else
        <div class="container-fluid"><h3>Ваши принятые задачи</h3>
            <table id="productSizes" class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-7">Задание</th>
                        <th class="col-5">Доп. информация</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks_accepted as $task)
                        <tr class="d-flex table-primary">
                            <td class="col-7">{{ $task->task_text }}</td>
                            @if($task->has_file == 0)
                                <td class="col-5">
                                    <form  method="POST" action="{{ route('accept_task', ['id' => $task->task_id, 'type' => 2]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info">Передать на проверку</button>
                                    </form>
                                </td>
                            @else
                                <td class="col-5">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <form  method="POST" action="{{ route('accept_task', ['id' => $task->task_id, 'type' => 2]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info">Передать на проверку</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <a type="button" class="btn btn-primary" href="{{ route('get_task_help_file', $task->task_id) }}">Скачать</a>
                                            </div>
                                        </div>
                                    </div>                                 
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($tasks_on_check->isEmpty())
    <div class="mt-2 ms-3">
        <h4>У вас нет задач на проверке</h4>
        <div class="line"></div>
    </div>
    @else
        <div class="container-fluid"><h3>Ваши задачи на проверке</h3>
            <table id="productSizes" class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-7">Задание</th>
                        <th class="col-5">Доп. информация</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks_on_check as $task)
                        <tr class="d-flex table-primary">
                            <td class="col-7">{{ $task->task_text }}</td>
                            @if($task->has_file == 0)
                                <td class="col-5">
                                    Нет доп. информации
                                </td>
                            @else
                                <td class="col-5">
                                    <div class="container">
                                            <div class="col">
                                                <a type="button" class="btn btn-primary" href="{{ route('get_task_help_file', $task->task_id) }}">Скачать</a>
                                            </div>
                                        </div>
                                    </div>                                 
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection