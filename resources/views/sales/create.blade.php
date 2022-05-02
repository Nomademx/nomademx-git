@extends('adminlte::page')

@section('title', 'Ventas')
@section('content')

{!! Form::open(array('route' => 'sales.store', 'method' => 'POST', 'enctype' => "multipart/form-data" )) !!}
        <div class="row card p-4">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('isbn', 'ISBN') !!}
                    {!! Form::text('isbn', null, array('class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('editorial', 'Editorial') !!}
                    {!! Form::text('editorial', null, array('class' => 'form-control')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('description', 'Descripción') !!}
                    {!! Form::text('description', null, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('stock', 'Disponibilidad') !!}
                    {!! Form::number('stock', null, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('image', 'Imagen') !!}
                    {!! Form::file('image', array('class' => 'form-control-file')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </div>

    {!! Form::close() !!}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/styles/sales.css"
@stop