@extends('app')

@section('title', 'Editar: Tarea')


@section('extra-styles')
    <link href="/assets/css/chosen.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Editar: {{$tarea->nombre}}</h1>
            </div>
        </header>
        <div id="tareas" class="col-md-8">

            {!! Form::model($tarea,array('url'=>'tareas/' . $tarea->id ,'method'=>'PATCH')) !!}
                <input type="hidden" name="updated_at" value="{{$tarea->updated_at}}" id="updated_at" readonly />
                <div class="form-group">
                    {!! Form::label('Titulo') !!}
                    {!! Form::text('titulo',null,['class'=>'form-control','placeholder'=>'Titulo','required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Descripción') !!}
                    {!! Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Descripción']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('Tiempo') !!}
                {!! Form::number('tiempo',null,['class'=>'form-control','required'=>'required']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('Cliente') !!}
                    <select class="chosen-select form-control" name="cliente_id" id="cliente_id">
                        @foreach($clientes as $cliente)
                            @if ($cliente->id == $tarea->cliente_id)
                            <option selected value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                            @else
                                <option  value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_proyecto_id">Tipo de proyecto</label>
                    <select class="chosen-select form-control" name="tipo_proyecto_id" id="tipo_proyecto_id">
                        @foreach($tiposProyecto as $tipoProyecto)
                            @if ($tipoProyecto->id == $tarea->tipo_proyecto_id)
                            <option selected value="{{$tipoProyecto->id}}">{{$tipoProyecto->nombre}}</option>
                            @else
                                <option value="{{$tipoProyecto->id}}">{{$tipoProyecto->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


            {!! Form::submit('Editar tarea',['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </section>


@endsection

@section('controls')
    {!! Form::open(array('url'=>'tareas/' . $tarea->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
       <button type="submit" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>
    {!! Form::close() !!}
@endsection

@section('extra-scripts')
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script>$(document).ready(function() {$('.chosen-select').chosen();});</script>
@endsection