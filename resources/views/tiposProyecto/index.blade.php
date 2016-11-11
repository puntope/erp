@extends('app')

@section('title', 'Tipos de proyecto')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Tipos de proyectos</h1>
            </div>
        </header>
        <div id="tiposProyecto" class="col-md-8">
            <ul class="list-group tipos">
                @foreach($tiposProyecto as $tipo)
                    <li class="list-group-item tipo">
                        <img class="pull-left tipo-logo" width="35" height="35" src="{{$tipo->logo}}" alt="{{$tipo->nombre}}" />
                        <h4 class="pull-left" style="margin-left: 15px;">{{$tipo->nombre}}</h4>
                        <a href="/proyectos/{{$tipo->id}}/edit" class="pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

@section('controls')
    <a class="mbtn green" id="nuevo" href="/proyectos/create"><span class="glyphicon-plus glyphicon white"></span></a>
@endsection
