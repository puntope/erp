@extends('app')

@section('title', 'Editar: Proyecto de desarrollo')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Editar: {{$desarrollo->nombre}}</h1>
            </div>
        </header>
        <div id="desarrollos" class="col-md-8">

            {!! Form::model($desarrollo,array('url'=>'desarrollos/' . $desarrollo->id ,'method'=>'PATCH')) !!}
                @include('tareas.desarrollo._form',array('sumbitBtnText'=>'Editar proyecto de desarrollo'))
            {!! Form::close() !!}



        </div>
    </section>


@endsection

@section('controls')
    {!! Form::open(array('url'=>'desarrollos/' . $desarrollo->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
       <button type="submit" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>
    {!! Form::close() !!}
@endsection