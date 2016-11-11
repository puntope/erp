@extends('app')

@section('title', 'Empleados')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Empleados</h1>
            </div>
        </header>
        <div id="empleados" class="col-md-8">
            <ul class="list-group tipos">
                @foreach($empleados as $empleado)

                    @if($empleado->active)
                    <li style="border-left: 3px solid {{$empleado->color}};" class="list-group-item cliente @if($empleado->rol_id == 4) inactive @endif">
                        <!-- TEMPORAL usar partials -->
                        <h4>{{$empleado->name}} {{$empleado->apellidos}}</h4>
                        <img src="/img/profiles/{{$empleado->avatar}}" alt="{{$empleado->alias}} avatar " class="img-circle" width="25" height="25" />
                        <a href="/user/{{$empleado->id}}/edit" class="icon pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="/user/{{$empleado->id}}" class="icon pull-right"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <div class="clearfix"></div>
                    </li>
                    @endif
                @endforeach
            </ul>


        </div>
    </section>
@endsection

@section('controls')
    <a class="mbtn green" id="nuevo" href="/user/create"><span class="glyphicon-plus glyphicon white"></span></a>
@endsection

