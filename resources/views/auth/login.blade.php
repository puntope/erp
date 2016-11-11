<!-- resources/views/auth/login.blade.php -->

@extends('auth')
    @section('content')
        <div class="login-wrapper">
            <div class="login-form-wrapper">
                <img class="login-logo" src="/img/ril-logo-blanco.png" />
                <form id="login-form" method="POST" action="/auth/login" class="text-left">
                    {!! csrf_field() !!}
                    <div class="login-form-main-message">
                        @if ($errors->any())
                            {{ implode('', $errors->all(':message')) }}
                        @endif
                    </div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="email" class="sr-only">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group login-group-checkbox">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Recuérdame</label>
                            </div>
                        </div>
                        <div id="sending-button-wrapper">
                            <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="etc-login-form">
                        <p><a href="/password/email">¿Olvidaste tu contraseña? </a></p>
                    </div>
                </form>
            </div>
        </div>
    @endsection