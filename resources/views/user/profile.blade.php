@extends('app')

    @section('title', $profile->name . ' ' . $profile->apellidos)
    @section('content')
        <div id="profile_wrapper" class="container">
            <div class="row" id="profile_basic">
                <div class="col col-sm-4" id="profile_avatar">
                    <img src="/img/profiles/{{$profile->avatar}}" alt="{{$profile->alias}} avatar" width="300" height="300" />
                    <p id="last_login">Ultima conexión el {{$profile->last_login->format('d-m-Y')}} a las {{$profile->last_login->format('H:i:s')}} <br /> ({{Carbon\Carbon::now()->diffForHumans(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$profile->last_login))}})</p>
                </div>
                <div class="col col-sm-6" id="profile_basic_info">
                    <div class="row">
                        <h2>{{$profile->name}} {{$profile->apellidos}}</h2>

                        @if (!is_null($profile->alias))
                            <span id="profile_alias">({{$profile->alias}})</span>
                        @endif
                   </div>

                    <div class="row" id="profile_contact_info">
                        <h3>Información de contacto</h3>
                        <p id="profile_movil"><span class="title">Móvil:</span><a href="tel:{{$profile->movil}}">{{$profile->movil}}</a></p>
                        <p id="profile_phone"><span class="title">Tel. Fijo:</span><a href="tel:{{$profile->movil}}">{{$profile->movil}}</a></p>
                        <p id="profile_email"><span class="title">Email:</span><a href="mailto:{{$profile->email}}">{{$profile->email}}</a></p>
                        <p id ="profile_fecha_nac"><span class="title">Fecha de nacimiento:</span><span>{{ $profile->fecha_nacimiento->format('d-m-Y') }} ( {{$profile->fecha_nacimiento->age}} años)</span></p>
                        <p id="profile_direccion"><span class="title">Dirección:</span>
                        <address>
                            {{$profile->direccion}}<br />
                            {{$profile->cp}} {{$profile->ciudad}}<br />
                            {{$profile->provincia}} ({{$profile->pais}})
                        </address>
                        </p>
                    </div>



                </div>

                <div class="col col-sm-6" id="profile_rol_info">

                </div>

            </div>
        </div>
    @endsection