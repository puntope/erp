@extends('app')

@section('title', $cliente->nombre)
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">


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
                <div class="title-head">
                    <h1 style="display: inline-block;">Tareas {{$cliente->nombre}} · <span style="color:#777;">{{\Jenssegers\Date\Date::today()->format('F Y')}}</span> </h1>
                </div>
                <div class="info-head">
                    <h4 style="display: inline-block;" class="client-time"><strong class="{{$average}}">{{ $realizadas }}</strong> / {{$cliente->tiempo_mes}} <span class="average {{$masMenos}}">({{$restantes}})</span></h4>

                    <img class="img img-circle" style="display: inline-block;margin-left: 10px;" src="{{$cliente->logo}}" />
                </div>
            </div>
        </header>
        <div id="clientes" class="col-md-8">

            <ul class="list-group tareas">
           @foreach($cliente->tareas()->month()->get() as $tarea)
                    <li class="list-group-item tarea">
                    <div>
                        <div class="titulo"><h2>{{ $tarea->titulo }}</h2>
                            <span class="time">{{ $tarea->tiempo }}'</span>
                        </div>
                        <div class="metas">
                        <span class="tipo-info">
                                 {{ $tarea->created_at }}
                            </span>

                            <span class="tipo-info">
                                · {{ $tarea->tipoTarea()->first()->nombre }}
                            </span>

                             <span class="tipo-info">
                                · {{ $tarea->user()->first()->alias }}
                            </span>


                        </div>
                        <p>{{ $tarea->descripcion }}</p>
                    </div>
                    <div class="more-options">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span></span><span></span><span></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/tareas/{{$tarea->id}}">Editar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>


                        <div class="client-info pull-right">
                        </div>
                    </li>
           @endforeach
            </ul>
        </div>
    </section>
@endsection


