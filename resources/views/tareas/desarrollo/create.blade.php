@extends('app')

@section('title', 'Crear Proyecto de desarrollo')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Nuevo proyecto de desarrollo</h1>
            </div>
        </header>
        <div id="desarrollos" class="col-md-8">
            {!! Form::open(array('url'=>'desarrollos')) !!}
                @include('tareas.desarrollo._form',array('sumbitBtnText'=>'Nuevo desarrollo'))
            {!! Form::close() !!}
        </div>
    </section>

@endsection