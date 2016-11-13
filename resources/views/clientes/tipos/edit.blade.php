@extends('app')

@section('title', 'Editar: Tipo de cliente')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1 style="float:left;">Editar: {{$tipoCliente->name}}</h1>
            </div>
        </header>
        <div id="clientes" class="col-md-8">

            {!! Form::model($tipoCliente,array('url'=>'clientes/tipos/' . $tipoCliente->id ,'method'=>'PATCH')) !!}
            @include('clientes.tipos._form',array('sumbitBtnText'=>'Editar'))
            {!! Form::close() !!}



        </div>
    </section>


@endsection

@section('controls')
    {!! Form::open(array('url'=>'clientes/tipos/' . $tipoCliente->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
    <button type="submit" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>
    {!! Form::close() !!}
@endsection




