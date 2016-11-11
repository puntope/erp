@extends('app')

@section('title', 'Editar: Cliente')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1 style="float:left;">Editar: {{$cliente->nombre}}</h1>
                <img style="float:right;" src="{{$cliente->logo}}" />
            </div>
        </header>
        <div id="clientes" class="col-md-8">

            {!! Form::model($cliente,array('url'=>'clientes/' . $cliente->id ,'method'=>'PATCH', 'files'=>true)) !!}
            @include('clientes._form',array('sumbitBtnText'=>'Editar cliente'))
            {!! Form::close() !!}



        </div>
    </section>


@endsection

@section('controls')
    {!! Form::open(array('url'=>'clientes/' . $cliente->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
    <button type="submit" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>
    {!! Form::close() !!}
@endsection




