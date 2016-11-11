@extends('app')

@section('title', 'Análisis')

@section('extra-styles')
    <link href="/assets/css/chosen.min.css" rel="stylesheet" />
    <link href="/assets/css/default.css" rel="stylesheet" />
    <link href="/assets/css/default.date.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Análisis</h1>
            </div>
        </header>

        <div id="app-analisis">


            <div id="analisis-body" class="col-md-8">
                <div v-show="tareas.lenght <= 0">
                    <h2>Sin opciones de análisis.</h2>
                    <p>Selecciona alguno de los filtros de la derecha.</p>
                </div>
                <div id="listadoTareas">
                    <ul class="list-group tareas">
                        <li v-for="tarea in tareas"
                            class="list-group-item tarea"
                            data-id="@{{tarea.id}}">

                            <div class="tarea-basics">
                                <div class="titulo"><h2>@{{ tarea.titulo }}</h2>
                                    <span v-show="tarea.tiempo > 0" class="time">@{{ tarea.tiempo }}'</span>
                                </div>
                                <div class="metas">
                                    <span class="tipo-info">
                                        @{{ tarea.created_at }}
                                    </span>
                                    <template v-for="tipo in tiposProyecto">
                                        <span class="tipo-info" v-if="tipo.id == tarea.tipo_proyecto_id">
                                            · @{{ tipo.nombre }}
                                        </span>
                                    </template>

                                    <template v-for="user in usuarios">
                                        <span class="tipo-info" v-if="user.id == tarea.user_id">
                                            · @{{ user.alias }}
                                        </span>
                                    </template>
                                </div>
                                <p>@{{ tarea.descripcion }}</p>
                            </div>

                            <div class="more-options">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span></span><span></span><span></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/tareas/@{{tarea.id}}">Editar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <template v-for="cliente in clientes">
                                <div class="client-info pull-right" v-if="cliente.id == tarea.cliente_id">
                                    <img class="img img-circle" src="@{{ cliente.logo }}" alt="@{{ cliente.nombre }}" title="@{{cliente.nombre}}" />
                                </div>
                            </template>

                        </li>
                    </ul>
                </div>
            </div>


            <div id="sidebar" class="col-md-3 col-md-offset-1">
                <i class="glyphicon glyphicon-cog"></i><h4>Opciones</h4>
                <section id="filters">
                    <div class="form-group">
                        <label>Filtrar por cliente</label>
                        <p class="help-block">Obtener tareas según cliente.</p>
                        <select v-model="filtro.clientes" multiple data-placeholder="Selecciona uno o varios clientes" class="chosen-select" name="cliente_id" id="clientes_id">
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Filtrar por tipo de tarea</label>
                        <p class="help-block">Obtener tareas según tipo de tarea.</p>
                        <select v-model="filtro.tipotareas" multiple data-placeholder="Selecciona uno o varios tipos de proyecto" class="chosen-select" name="tipoTarea_id" id="tipotareas_id">
                            @foreach($tiposTareas as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Filtrar por empleado</label>
                        <p class="help-block">Obtener tareas según tipo de empleado.</p>
                        <select v-model="filtro.empleados" multiple data-placeholder="Selecciona uno o varios empleados" class="chosen-select" name="user_id" id="empleados_id">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Filtrar por fecha</label>
                        <p class="help-block">Obtener tareas entre dos fechas.</p>

                        <input v-model="filtro.desde" class="form-control" placeholder="Desde..." type="date" id="fechaInicio" name="fechaInicio" />
                        <br />
                        <input v-model="filtro.hasta" class="form-control" placeholder="Hasta..." type="date" id="fechaFin" name="fechaFin" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" v-on:click.prevent="obtenerResultados()"  id="getAnalisis">Obtener resultados</button>
                        <button class="btn btn-default" v-on:click.prevent="descargarResultados()"  id="getDescarga">Descargar resultados</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('controls')

@endsection

@section('extra-scripts')
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script src="/assets/js/picker.js"></script>
    <script src="/assets/js/picker.date.js"></script>
    <script src="/assets/js/es_ES.js"></script>
    <script src="/assets/js/analisis.js"></script>
@endsection
