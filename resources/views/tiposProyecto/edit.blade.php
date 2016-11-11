@extends('app')

@section('title', 'Editar: Tipos de proyecto')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Editar: {{$tipo->nombre}}</h1>
            </div>
        </header>
        <div id="tiposProyecto" class="col-md-8">

            {!! Form::model($tipo,array('url'=>'proyectos/' . $tipo->id ,'method'=>'PATCH', 'files'=>true)) !!}
                @include('tiposProyecto._form',array('sumbitBtnText'=>'Editar tipo de proyecto'))
            {!! Form::close() !!}



        </div>
    </section>


@endsection

@section('controls')
    {!! Form::open(array('url'=>'proyectos/' . $tipo->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
       <button type="submit" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>
    {!! Form::close() !!}
@endsection