@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
@stop

@section('content')

    
<div class="card p-4">
    <div class="row d-flex justify-content-center mt-4">
                                <div class="card col-8">
                                    <h5 class="card-header text-center"><span class="fas fa-user-tie"></span> Agente</h5>
                                    <div class="card-body">

                                        <div class="row d-flex justify-content-center">
                                            <div class="col-4 mt-1">
                                                @if ($user->image == null)
                                                <img class="img-fluid rounded" 
                                                    style="width: 200px; height:250px; object-fit: cover" 
                                                    src="/storage/UserImages/default-user-icon-8.jpg" 
                                                    alt="{{ $user->name }}"/>
                                                @else
                                                <img class="img-fluid rounded" 
                                                    style="width: 200px; height:200px; object-fit: cover" 
                                                    src="/storage/{{ $user->image }}" 
                                                    alt="{{ $user->name }}"/>
                                                @endif
                                                    
                                            </div>
                                            
                                            <div class="col-8 mt-4">
                                                    <div>
                                                        <label for="name" class="form-label">Nombre</label>
                                                        <input type="text" id="name" class="form-control" placeholder="{{$user->name}}" readonly>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-8">
                                                            <label for="email" class="form-label">Correo</label>
                                                            <input type="email" id="email" class="form-control" placeholder="{{$user->email}}" readonly>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="phone_number" class="form-label">Teléfono</label>
                                                            <input type="phone_number" id="phone_number" class="form-control" placeholder="{{$user->phone_number}}" readonly>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    </div>

    <div class="row d-flex justify-content-center mt-4">
        <div class="card col-12">
            <h5 class="card-header text-center"><span class="fas fa-sign"></span> Ventas</h5>
            @if($user->sales->count() > 0)
            <div class="card-body">
                <div class="outer-div">
                                        @foreach ($user->sales as $sale)
                                            <div class="house-card">
                                                <div class="background-img-container">
                                                    <a href="{{ route('sales.show', $sale->id) }}" target="_blank"><img class="background-img" src="/storage/{{$sale->image}}"></a>
                                                    <span class="price">${{ $sale->price }}</span>
                                                </div>

                                                
                                                <div class="house-caption">
                                                    <small class="suburb"><span class="fas fa-map-marker-alt"></span> {{ $sale->suburb->suburb_name }}, {{ $sale->city->city_name }}.</small>
                                                    <p class="status">{{ $sale->status }}</p>
                                                </div>

                                                <div class="house-contact">
                                                    <div>
                                                        <p><strong>Agente: </strong><span>{{ $sale->user->name }}</span></p>
                                                        <p><strong>Publicación: </strong><span>{{ $sale->created_at->format('d M, Y') }}</span></p>
                                                    </div>
                                                    <a href="#" target="_blank"><img class="user-img" src="/storage/{{ $sale->user->image }}" alt=""></a>
                                                </div>
                                            </div>
                                        @endforeach
                </div>
            </div>
            @elseif($user->id == $loggedUser->id)
            <div class="card-body">
                <div class="text-center">
                    <h3>No tienes ninguna venta.</h3>
                    <p><a href="/sales/create" role="button" class="btn btn-primary">Registra tu primera venta!</a></p>
                </div>
            </div>
            @else
            <div class="card-body">
                <div class="text-center">
                    <h3>Este agente no ha hecho ninguna venta.</h3>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/styles/sales.css">

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

