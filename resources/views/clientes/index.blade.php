@extends('app')

@section('title', 'Clientes')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Clientes</h1>
            </div>
        </header>
        <div id="clientes" class="col-md-8">
            <ul class="list-group tipos">
                @foreach($clientes as $cliente)

                    <li style="border-left: 3px solid {{$cliente->color}};" class="list-group-item cliente">
                        <!-- TEMPORAL usar partials -->
                        <h4>{{$cliente->nombre}}</h4>
                        <?php
                            $realizadas = round($cliente->tareas()->HorasMesMantenimiento()->sum('tiempo')/60,1);
                            $restantes = round($cliente->tiempo_mes - $realizadas,1);

                            if ($restantes < 0) {
                                $average = 'text-danger';
                                $masMenos = 'text-danger';
                            } else if ($restantes < (($cliente->tiempo_mes/100) * 10)) {
                                $average = 'text-warning';
                                $masMenos = 'text-success';
                            } else {
                                $average = 'primary';
                                $masMenos = 'text-success';
                            }

                        ?>
                        <span class="client-time"><strong class="{{$average}}">{{ $realizadas }}</strong> / {{$cliente->tiempo_mes}} <span class="average {{$masMenos}}">({{$restantes}})</span></span>
                        <a href="/clientes/{{$cliente->id}}/edit" class="icon pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="/clientes/{{$cliente->id}}" class="icon pull-right"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>

            <h2>Otros</h2>
            <ul class="list-group tipos otros">
                <!-- TEMPORAL usar partials -->
                @foreach($otros as $cliente)

                    <li style="border-left: 3px solid {{$cliente->color}};" class="list-group-item cliente">
                        <h4>{{$cliente->nombre}}</h4>
                        <span class="client-time"><strong>{{round($cliente->tareas()->HorasMesMantenimiento()->sum('tiempo')/60,1)}}</strong> / {{$cliente->tiempo_mes}}</span>
                        <a href="/clientes/{{$cliente->id}}/edit" class="icon pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="/clientes/{{$cliente->id}}" class="icon pull-right"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <div class="clearfix"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

@section('controls')
    <a class="mbtn green" id="nuevo" href="/clientes/create"><span class="glyphicon-plus glyphicon white"></span></a>
@endsection

