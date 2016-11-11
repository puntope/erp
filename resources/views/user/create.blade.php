@extends('app')

@section('title', 'Crear usuario')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Nuevo usuario</h1>
            </div>
        </header>
        <div id="usuario" class="col-md-8">
            {!! Form::open(array('url'=>'user','method'=>'POST','files'=>true)) !!}
            @include('user._form',array('sumbitBtnText'=>'Nuevo usuario'))
            {!! Form::close() !!}
        </div>
    </section>

@endsection
