@extends('app')

@section('title', 'Crear cliente')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Nuevo cliente</h1>
            </div>
        </header>
        <div id="cliente" class="col-md-8">
            {!! Form::open(array('url'=>'clientes','method'=>'POST','files'=>true)) !!}
            @include('clientes._form',array('sumbitBtnText'=>'Nuevo cliente'))
            {!! Form::close() !!}
        </div>
    </section>

@endsection
