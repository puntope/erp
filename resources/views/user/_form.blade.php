<fieldset class="basics-border">
    <legend class="basics-border">Datos de usuario</legend>

        <div class="form-group">
            {!! Form::label('Nombre') !!}
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','required'=>'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Apellidos') !!}
            {!! Form::text('apellidos',null,['class'=>'form-control','placeholder'=>'Apellidos','required'=>'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Email') !!}
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'E-mail','required'=>'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Alias') !!}<span class="more-info"><i class="fa fa-info"></i></span>
            <div class="the-info">El alias debe ser único, identifica y nombra al usuario en las tareas.</div>
            {!! Form::text('alias',null,['class'=>'form-control','placeholder'=>'Alias','required'=>'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Avatar') !!}
            {!! Form::file('avatar') !!}
        </div>


    </fieldset>

<fieldset class="basics-border">
    <legend class="basics-border">Privilegios</legend>
    <div class="form-group">
        {!! Form::label('Rol') !!}
        <select class="chosen-select form-control" name="rol_id" id="rol_id">
            @foreach(\App\Roles::all() as $rol)
                @if (isset($user) && $rol->id == $user->rol_id)
                    <option selected value="{{$rol->id}}">{{$rol->nombre}}</option>
                @else
                    <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {!! Form::label('Activo') !!}
        Sí {!! Form::radio('active','1') !!}
        No {!! Form::radio('active','0') !!}
    </div>




</fieldset>

<fieldset class="basics-border">
    <legend class="basics-border">Datos adicionales</legend>

    <div class="form-group">
        {!! Form::label('Dirección') !!}
        {!! Form::textarea('direccion',null,['class'=>'form-control','placeholder'=>'Dirección']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Ciudad') !!}
        {!! Form::text('ciudad',null,['class'=>'form-control','placeholder'=>'Ciudad']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Provincia') !!}
        {!! Form::text('provincia',null,['class'=>'form-control','placeholder'=>'Provincia']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Código Postal') !!}
        {!! Form::text('cp',null,['class'=>'form-control','placeholder'=>'CP']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('País') !!}
        {!! Form::text('pais',null,['class'=>'form-control','placeholder'=>'País']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Móvil') !!}
        {!! Form::text('movil',null,['class'=>'form-control','placeholder'=>'Teléfono móvil']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Fijo') !!}
        {!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Teléfono fijo']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('NIF') !!}
        {!! Form::text('nif',null,['class'=>'form-control','placeholder'=>'Nif']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('IBAN') !!}
        {!! Form::text('iban',null,['class'=>'form-control','placeholder'=>'IBAN']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Fecha de nacimiento') !!}
        {!! Form::date('fecha_nacimiento',null,['class'=>'form-control']) !!}
    </div>

</fieldset>


<input type="hidden" name="puesto_id" value="1">
<input type="hidden" name="nivel_id" value="1">

{!! Form::submit($sumbitBtnText,['class'=>'btn btn-primary']) !!}
