@extends('app')

@section('title', 'Editar: Usuario')
@section('content')
    <section class="container-fluid">
        <header class="row">
            <div class="col col-xs-12">
                <h1 style="float:left;">Editar: {{$user->name}}</h1>
            </div>
        </header>
        <div id="usuarios" class="col-md-8">

            {!! Form::model($user,array('url'=>'user/' . $user->id ,'method'=>'PATCH', 'files'=>true)) !!}
            @include('user._form',array('sumbitBtnText'=>'Editar usuario'))
            {!! Form::close() !!}



        </div>
    </section>


@endsection

@section('controls')


    <button data-toggle="modal" type="submit" data-target="#delete" class="delete"><span class="glyphicon glyphicon-minus white"></span></button>

    <!-- Delete Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Estás seguro?</h4>
                </div>
                <div class="modal-body">
                    SI borras el usuario, todas sus tareas pasarána  ser de Javier Rioja. Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    {!! Form::open(array('url'=>'user/' . $user->id ,'method'=>'DELETE', 'class'=>'mbtn red')) !!}
                    <button type="submit" class="btn btn-danger">Borrar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection




