

@extends('theme_layout.header')
{{--{{ dd(request()->url()) }}--}}

@section('title', 'Nomademx')

@section('content')

<div class="relative flex items-top justify-center min-h-screen bg-gray-200	 dark:bg-gray-200 sm:items-center py-4 sm:pt-0">


    <div>
        <img src="{{ asset('images/nomademx-logo.png') }}" class="animate__animated animate__fadeIn " alt="" width="480px" height="100px">
    </div>

</div>

@endsection
