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

@section('title', 'Acciones comerciales')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1>Acciones comerciales</h1>
            </div>
        </header>
        <div id="comerciales" class="col-md-8">
            <ul class="list-group desarollo-ul">
                @foreach($comerciales as $comercial)
                    <li class="list-group-item comercial">
                        <div>
                            @if($comercial->cliente())
                                <img class="img img-circle" src="{{ $comercial->cliente()->first()->logo }}" alt="{{ $comercial->cliente()->first()->nombre }}" title="{{$comercial->cliente()->first()->nombre}}" />
                            @endif
                            @if($comercial->tipoProyecto())
                                <div class="info">
                                    <h3>{{ $comercial->nombre }}</h3>
                                    <p><strong>{{$comercial->cliente()->first()->nombre}}</strong></p>
                                    <p>{{$comercial->tipoProyecto()->first()->nombre}}</p>
                                </div>
                            @endif
                                <div id="estado-graphic">
                                    <div class="estados">
                                        @foreach($estados as $estado)
                                            <div class="estado  @if ($estado == $comercial->estado()->first()) active @endif">
                                                <a href="/comerciales/{{$comercial->id}}/estado/{{$estado->id}}">
                                                    <i class="sphere" style="background:{{$estado->color}}"></i>
                                                    <span>{{$estado->nombre}}</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="edit-view">
                                    <a href="/comerciales/{{$comercial->id}}/promotion" class="icon"><span class="glyphicon glyphicon-star"></span></a>
                                    <a href="/comerciales/{{$comercial->id}}/edit" class="icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="{{$comercial->presupuesto}}" class="icon"><span class="glyphicon glyphicon-file"></span></a>
                                </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

@section('controls')
    <a class="mbtn green" id="nuevo" href="/comerciales/create"><span class="glyphicon-plus glyphicon white"></span></a>
@endsection