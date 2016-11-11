<div class="form-group">
    {!! Form::label('Nombre') !!}
    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Descripcion') !!}
    {!! Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Descripción']) !!}
</div>

<div class="form-group">
    {!! Form::label('Horas estimadas') !!}
    {!! Form::number('horas',null,['class'=>'form-control','placeholder'=>'50','required'=>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Cliente') !!}
    {!! Form::select('cliente_id',array_pluck($clientes,'nombre','id'), null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('TipoProyecto') !!}
    {!! Form::select('tipo_proyecto_id',array_pluck($tiposProyectos,'nombre','id'), null,['class'=>'form-control']) !!}
</div>



{!! Form::submit($sumbitBtnText,['class'=>'btn btn-primary']) !!}
