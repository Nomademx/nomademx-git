@extends('adminlte::page')

@section('title', 'Usuarios')
@section('content')

<div class="card">
    
    <div class="card-body"">

        <div class="outer-div">
            @foreach ($agents as $agent)
            <div class="user-card">
                <img class="background-img">
                <div class="user-img-container">
                    @if ($agent->image == null)
                    <img class="user-img" src="/storage/UserImages/default-user-icon-8.jpg" alt="{{$agent->name}}">
                    @else
                    <img class="user-img" src="/storage/{{ $agent->image }}" alt="{{ $agent->name }}">
                    @endif
                </div>
                <div class="user-text">
                    <a href="{{ route('users.getAgent', $agent->id) }}"><h4>{{$agent->name}}</h4></a>
                    <p><span class="fa fa-star"></span> 4.5</p>
                    <p><span class="fas fa-map-marker-alt"></span> Puerto Vallarta</p>
                    <a href="#"><p><span class="fas fa-sign"></span> Ventas</p></a>
                </div>

            </div>

            @endforeach
        </div>

    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/styles/agents.css"
@stop