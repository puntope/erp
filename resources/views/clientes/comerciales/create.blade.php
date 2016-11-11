@extends('app')

@section('title', 'Crear nueva Acción comercial')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Nueva acción comercial</h1>
            </div>
        </header>
        <div id="comerciales" class="col-md-8">
            {!! Form::open(array('url'=>'comerciales', 'files' => true)) !!}
                @include('clientes.comerciales._form',array('sumbitBtnText'=>'Guardar'))
            {!! Form::close() !!}
        </div>
    </section>

@endsection