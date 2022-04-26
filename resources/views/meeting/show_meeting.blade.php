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
                    <h4 class="card-title">{{ $meeting->meeting_name}}</h4>
                    <p class="card-text">{{ $meeting->description }}</p>
                </div>
            </div>  
        </div>
    </div>
@endsection
