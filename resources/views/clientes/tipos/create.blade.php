@extends('app')

@section('title', 'Crear tipo de cliente')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Nuevo tipo de cliente</h1>
            </div>
        </header>
        <div id="cliente" class="col-md-8">
            {!! Form::open(array('url'=>'clientes/tipos','method'=>'POST')) !!}
            @include('clientes.tipos._form',array('sumbitBtnText'=>'Crear'))
            {!! Form::close() !!}
        </div>
    </section>

@endsection
