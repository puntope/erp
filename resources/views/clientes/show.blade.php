@extends('app')

@section('title', $cliente->nombre)
@section('extra-styles')
    <link href="/assets/css/chosen.min.css" rel="stylesheet" />
    <link href="/assets/css/default.css" rel="stylesheet" />
    <link href="/assets/css/default.date.css" rel="stylesheet" />
@endsection
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">



                <div class="title-head">
                    <h1 style="display: inline-block;">Tareas {{$cliente->nombre}} · <span style="color:#777;">{{\Jenssegers\Date\Date::createFromDate($ano,$mes,01)->format('F Y')}}</span> </h1>
                </div>
                <div class="info-head">
                    <h4 style="display: inline-block;" class="client-time"><strong class="{{$average}}">{{ $realizadas }}</strong> / {{$cliente->tiempo_mes}} <span class="average {{$masMenos}}">({{$restantes}})</span></h4>

                    <img class="img img-circle" style="display: inline-block;margin-left: 10px;" src="{{$cliente->logo}}" />
                </div>
            </div>
        </header>
        <div id="clientes" class="col-md-8">

            <ul class="list-group tareas">
           @foreach($cliente->tareas()->horasMesMantenimiento($mes,$ano)->get() as $tarea)
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
        <div id="sidebar" class="col-md-3 col-md-offset-1">
            <i class="glyphicon glyphicon-cog"></i><h4>Opciones</h4>
            <section id="filters">
                <div class="form-group">
                    <label>Filtrar por fecha</label>
                    <p class="help-block">Obtener tareas de otros meses y años pasados.</p>
                    <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" />
                </div>
                <div class="form-group">
                    <a class="btn btn-default" id="getFecha" href="/clientes/{{$cliente->id}}">Obtener resultados</a>
                </div>
            </section>
    </section>
@endsection

@section('extra-scripts')
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script src="/assets/js/picker.js"></script>
    <script src="/assets/js/picker.date.js"></script>
    <script src="/assets/js/es_ES.js"></script>
    <script src="/assets/js/clientes.js"></script>
@endsection


