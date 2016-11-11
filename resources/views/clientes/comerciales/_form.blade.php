@section('extra-styles')
    <link href="/assets/css/chosen.min.css" rel="stylesheet" />
@endsection

<div class="form-group">
    {!! Form::label('Nombre') !!}
    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Descripcion') !!}
    {!! Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Descripción']) !!}
</div>

<div class="form-group">
    {!! Form::label('Horas estimadas (servicio unico)') !!}
    {!! Form::number('horas',null,['class'=>'form-control','placeholder'=>'0']) !!}
</div>

<div class="form-group">
    {!! Form::label('Horas estimadas (mensuales)') !!}
    {!! Form::number('horas_mes',null,['class'=>'form-control','placeholder'=>'10']) !!}
</div>


<div class="form-group">
    {!! Form::label('Presupuesto (PDF)') !!}
    {!! Form::file('presupuesto') !!}
</div>

<div class="form-group">
    {!! Form::label('Cliente') !!}
    {!! Form::select('cliente_id',array_pluck($clientes,'nombre','id'), null,['class'=>'chosen form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('TipoProyecto') !!}
    {!! Form::select('tipo_proyecto_id',array_pluck($tipos_proyecto,'nombre','id'), null,['class'=>'chosen form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Estado de negociación') !!}
    {!! Form::select('estado_id',array_pluck($estados,'nombre','id'), null,['class'=>'chosen form-control']) !!}
</div>



{!! Form::submit($sumbitBtnText,['class'=>'btn btn-primary']) !!}
@if(isset($comercial->presupuesto))
    <a class="btn btn-warning" href="{{$comercial->presupuesto}}">Ver presupuesto</a>
@endif
@if(isset($comercial))
    <a class="btn btn-success" href="/comerciales/{{$comercial->id}}/prmotion">Promocionar</a>
@endif


@section('extra-scripts')
    <script src="/assets/js/chosen.jquery.min.js"></script>
    <script>
        $('.chosen').chosen();
    </script>
@endsection