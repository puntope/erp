@extends('app')

@section('title', 'Editar: Acción comercial')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Acción comercial: {{$comercial->nombre}}</h1>
            </div>
        </header>
        <div id="comerciales" class="col-md-8">

            {!! Form::model($comercial,array('url'=>'comerciales/' . $comercial->id ,'files' => true, 'method'=>'PATCH')) !!}
                @include('clientes.comerciales._form',array('sumbitBtnText'=>'Guardar'))
            {!! Form::close() !!}



        </div>
    </section>


@endsection

@section('controls')
    {!! Form::open(array('url'=>'comerciales/' . $comercial->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
       <button type="submit" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>
    {!! Form::close() !!}
@endsection
