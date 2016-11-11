@extends('app')

@section('title', 'Tareas')

@section('extra-styles')
    <link href="/assets/css/chosen.min.css" rel="stylesheet" />
@endsection

@section('content')


    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Tareas</h1>
            </div>
        </header>
        <div id="misTareas" class="col-md-8">


            <!-- use the modal component, pass in the prop -->
            <modal :show.sync="showModal"></modal>

        <form action="POST" id="crearTarea" v-on:submit.prevent="crearTarea">
            <div class="form-group">
                <label for="titulo">
                    Título
                    <span class="required" v-if="! nuevaTarea.titulo">*</span>
                </label>
                <input autofocus required v-model="nuevaTarea.titulo" id="titulo" type="text" name="titulo" class="form-control" />
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea v-model="nuevaTarea.descripcion" id="descripcion" name="descripcion" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="tiempo">
                    Minutos invertidos
                    <span class="required" v-if="! nuevaTarea.tiempo">*</span>
                </label>
                <input required v-model="nuevaTarea.tiempo" id="tiempo" type="number" name="tiempo" class="form-control" />
            </div>

            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select v-model="nuevaTarea.cliente_id" class="chosen-select form-control" name="cliente_id" id="cliente_id">
                    @foreach($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_proyecto_id">Tipo de proyecto</label>
                <select v-model="nuevaTarea.tipo_proyecto_id" class="chosen-select form-control" name="tipo_proyecto_id" id="tipo_proyecto_id">
                    @foreach($tiposProyecto as $tipoProyecto)
                        <option @click="cargarDesarrollos(nuevaTarea.tipo_proyecto_id)" value="{{$tipoProyecto->id}}">{{$tipoProyecto->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div v-if="nuevaTarea.tipo_proyecto_id > 1" class="form-group">
                <label for="desarrollo_id">Proyecto</label>
                <select v-model="nuevaTarea.desarrollo_id" class="chosen-select form-control" name="desarrollo_id" id="desarrollo_id">
                    <option v-for="desarrollo in desarrollos" value="@{{ desarrollo.id }}">@{{desarrollo.nombre}}</option>
                </select>
            </div>

                <input value="{{Auth::user()->id}}" type="hidden" v-model="nuevaTarea.user_id" class="form-control" name="user_id" id="user_id" readonly />


            <div class="form-group">
                <button class="btn btn-primary" v-attr="disabled: errors">Añadir tarea</button>
            </div>

        </form>
        <hr />
        <ul class="list-group tareas">
            <li
                    v-for="tarea in tareas | orderBy 'created_at' -1 | filterBy search"
                    :class="{editing: tarea == completedTarea}"
                    class="list-group-item tarea"
                    data-id="@{{tarea.id}}"
                    @dblclick="completingTarea(tarea)">
                <div class="tarea-basics">
                    <div class="titulo"><h2>@{{ tarea.titulo }}</h2>
                        <input
                                id="tiempo"
                                type="number"
                                name="tiempo"
                                placeholder="Minutos"
                                class="form-control edit"
                                v-tarea-focus="tarea == completedTarea"
                                v-model="tarea.tiempo"
                                @blur="doneTarea(tarea)"
                                @keyup.enter="doneTarea(tarea)"
                        required />
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

                    </div>
                    <p>@{{ tarea.descripcion }}</p>
                </div>
                <div class="more-options">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span></span><span></span><span></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/tareas/@{{tarea.id}}">Editar</a></li>
                                <li><a href="#" v-on:click.prevent="borrarTarea(tarea.id)" id="delete-tarea">Borrar</a></li>
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
        </section>


@endsection
@section('extra-scripts')
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script src="/assets/js/tareas.js"></script>
@endsection


