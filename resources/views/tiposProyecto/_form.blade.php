<div class="form-group">
    {!! Form::label('nombre') !!}
    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('Logo') !!}
    {!! Form::file('logo') !!}
</div>
{!! Form::submit($sumbitBtnText,['class'=>'btn btn-primary']) !!}
