@extends('layout_profile.layout_main')

@section('title', 'Совещания: ' . session('user_name'))

@section('header')
    @extends('layout_profile.header')
@endsection

@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('create_meeting') }}">Создать собрание</a>
    <a type="button" class="btn btn-secondary" href="{{ route('make_secretary') }}">Дать поручение</a>
    @if ($meetings->isEmpty())
        <p class="mt-3">Создайте ваше первое собрание</p>
    @else
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Собрание</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Дата проведения</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($meetings as $meeting)
                    @if ($meeting->is_online == 1)
                        <tr class="mt-3 list-group-item-primary">
                    @elseif($meeting->is_online == 2)
                        <tr class="mt-3 list-group-item-success">
                    @elseif($meeting->is_online == 0)
                        <tr class="mt-3 list-group-item-secondary">
                    @endif
                    
                        <td><a href="{{ route('show_meeting', $meeting->meeting_id) }}">{{ $meeting->meeting_name }}</a></td>
                        <td>{{ $meeting->description }}</td>
                        <td>{{ $meeting->meeting_time }}</td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    @endif
@endsection
