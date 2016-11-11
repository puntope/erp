@extends('app')

<style>

    .edit-view {
        position: absolute;
        bottom: 15px;
        right: 15px;
    }

    #tipo_info p {
        margin-top: 15px;
        margin-left: 10px;
    }

    .edit-view a {
        margin-left: 10px;
        color: #777;
    }

    .edit-view a:hover {
        color: #ddd;
    }

    .desarrollo .client {
        width: 100%;
        border-bottom: 1px solid #eee;
        margin-bottom: 10px;
        padding: 0 0 5px;
    }
    .desarrollo .client img, .desarrollo .client h3 {
        display: inline-block;
    }
    .desarrollo .client img {
        width: 30px;
        float: right;
        margin: 10px 0;
    }
    .desarrollo .client h3 {
        margin: 10px 0;
        vertical-align: middle;
    }
</style>

@section('title', 'Desarrollo web')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Proyectos de desarrollo</h1>

            </div>
        </header>
        <div id="desarrollos" class="col-md-8">
            <ul class="list-group desarollo-ul">
                @foreach($desarrollos as $desarrollo)
                    <li class="list-group-item desarrollo">
                        <div class="client pull-left">
                            <img class="img img-circle" src="{{ $desarrollo->cliente()->first()->logo }}" alt="{{ $desarrollo->cliente()->first()->nombre }}" title="{{$desarrollo->cliente()->first()->nombre}}" />
                            <h3>{{ $desarrollo->cliente()->first()->nombre }}</h3>
                            <div id="tipo_info">
                                <img class="img img-circle pull-left"  src="{{ $desarrollo->tipoProyecto()->first()->logo }}" alt="{{ $desarrollo->tipoProyecto()->first()->nombre }}" title="{{$desarrollo->tipoProyecto()->first()->nombre}}" />
                                <p class="pull-left">{{$desarrollo->tipoProyecto()->first()->nombre}}</p>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="info pull-left">
                            <h4>{{$desarrollo->nombre}}</h4>
                            <p>{{$desarrollo->descripcion}}</p>
                            <?php
                            $tareas = $clientes->find($desarrollo->cliente()->first()->id)->tareas();

                            $realizadas = round($tareas->horasDesarrollo($desarrollo->id)->sum('tiempo')/60,1);
                            $restantes = round($desarrollo->horas - $realizadas,1);

                            if ($restantes < 0) {
                                $average = 'text-danger';
                                $masMenos = 'text-danger';
                            } else if ($restantes < (($desarrollo->horas/100) * 10)) {
                                $average = 'text-warning';
                                $masMenos = 'text-success';
                            } else {
                                $average = 'primary';
                                $masMenos = 'text-success';
                            }
                            ?>
                            <span class="client-time"><strong class="{{$average}}">{{ $realizadas }}</strong> / {{$desarrollo->horas}} <span class="average {{$masMenos}}">({{$restantes}})</span></span>

                        </div>
                        <div class="edit-view">
                            <a href="/api/desarrollos/finalizar/{{$desarrollo->id}}" class="icon" title="finalizar"><span class="glyphicon glyphicon-ok"></span></a>
                            <a href="/desarrollos/{{$desarrollo->id}}/edit" class="icon"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="/desarrollos/{{$desarrollo->id}}" class="icon"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>

                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

@section('controls')
    <a class="mbtn green" id="nuevo" href="/desarrollos/create"><span class="glyphicon-plus glyphicon white"></span></a>
@endsection