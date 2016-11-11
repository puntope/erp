@extends('app')

@section('title', 'Tipos de proyecto')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Nuevo tipo de proyecto</h1>
            </div>
        </header>
        <div id="tiposProyecto" class="col-md-8">
            {!! Form::open(array('url'=>'proyectos','files'=>true)) !!}
                @include('tiposProyecto._form',array('sumbitBtnText'=>'Nuevo tipo de proyecto'))
            {!! Form::close() !!}
        </div>
    </section>

@endsection