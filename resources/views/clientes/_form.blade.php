<div class="form-group">
    {!! Form::label('nombre') !!}
    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Tiempo mes (horas)') !!}
    {!! Form::number('tiempo_mes',null,['class'=>'form-control','placeholder'=>'10','required'=>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Tipo de cliente') !!}
    {!! Form::select('tipo_cliente_id',array_pluck($tiposClientes,'nombre','id'), null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('visible','¿Cliente visible?') !!}
    Sí {!! Form::radio('visible', 1) !!}
    No {!! Form::radio('visible', 0) !!}
</div>

<div class="form-group">
    {!! Form::label('active','¿Activo?') !!}
    Sí {!! Form::radio('active', 1) !!}
    No {!! Form::radio('active', 0) !!}
</div>



<div class="form-group">
    {!! Form::label('Logo') !!}
    {!! Form::file('logo') !!}
</div>

<div class="form-group">
    {!! Form::label('Color') !!}
    {!! Form::input('color','color') !!}
</div>
{!! Form::submit($sumbitBtnText,['class'=>'btn btn-primary']) !!}
