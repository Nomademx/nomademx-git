@extends('adminlte::page')

@section('title', 'Ventas')
@section('content')

<div class="card">
    <a href="/sales/create" role="button" class="btn btn-primary">Nueva venta</a>

    <div class="card-body">
        <div class="outer-div">
                <div class="house-card">
                    <div class="background-img-container">
                        <a href="#" target="_blank"><img class="background-img" src="/img/house1.jpg"></a>
                        <span class="price">$900</span>
                    </div>

                    
                    <div class="house-caption">
                        <small class="suburb">Fraccionamiento Parques Universidad</small>
                        <p class="status">Active</p>
                    </div>

                    <div class="house-contact">
                        <div>
                            <p><strong>Agente: </strong><span>Coral Cordova</span></p>
                            <p><strong>Publicación: </strong><span>30 de Abril, 2022.</span></p>
                        </div>
                        <a href="#" target="_blank"><img class="user-img" src="/img/doge.jpg" alt=""></a>
                    </div>
                </div>
                <div class="house-card">
                    <div class="background-img-container">
                        <a href="#" target="_blank"><img class="background-img" src="/img/house1.jpg"></a>
                        <span class="price">$900</span>
                    </div>

                    
                    <div class="house-caption">
                        <small class="suburb">Fraccionamiento Parques Universidad</small>
                        <p class="status">Active</p>
                    </div>

                    <div class="house-contact">
                        <div>
                            <p><strong>Agente: </strong><span>Coral Cordova</span></p>
                            <p><strong>Publicación: </strong><span>30 de Abril, 2022.</span></p>
                        </div>
                        <a href="#" target="_blank"><img class="user-img" src="/img/doge.jpg" alt=""></a>
                    </div>
                </div>
                <div class="house-card">
                    <div class="background-img-container">
                        <a href="#" target="_blank"><img class="background-img" src="/img/house1.jpg"></a>
                        <span class="price">$900</span>
                    </div>

                    
                    <div class="house-caption">
                        <small class="suburb">Fraccionamiento Parques Universidad</small>
                        <p class="status">Active</p>
                    </div>

                    <div class="house-contact">
                        <div>
                            <p><strong>Agente: </strong><span>Coral Cordova</span></p>
                            <p><strong>Publicación: </strong><span>30 de Abril, 2022.</span></p>
                        </div>
                        <a href="#" target="_blank"><img class="user-img" src="/img/doge.jpg" alt=""></a>
                    </div>
                </div>
        </div>
    </div>
        
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/styles/sales.css"
@stop