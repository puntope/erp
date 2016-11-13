<div class="form-group">
    {!! Form::label('Nombre') !!}
    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
</div>

{!! Form::submit($sumbitBtnText,['class'=>'btn btn-primary']) !!}
