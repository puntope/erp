@extends('app')

@section('title', 'Tipos de clientes')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Tipos de clientes</h1>
            </div>
        </header>
        <div id="clientes" class="col-md-8">
            <ul class="list-group tipos">
                @foreach($tiposClientes as $tipoCliente)
                    <li class="list-group-item">
                        <div class="pull-left">
                            <h4>{{$tipoCliente->nombre}}</h4>
                        </div>
                       <div class="pull-right">
                           <a href="/clientes/tipos/{{$tipoCliente->id}}/edit" class="icon"><span class="glyphicon glyphicon-pencil"></span></a>
                       </div>
                       <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

@endsection

@section('controls')
    <a class="mbtn green" id="nuevo" href="/clientes/tipos/create"><span class="glyphicon-plus glyphicon white"></span></a>
@endsection

