

<!-- resources/views/auth/password.blade.php -->
@extends('auth')
@section('content')
    <div class="login-wrapper">
    <div class="login-form-wrapper">
        <img class="login-logo" src="/img/ril-logo-blanco.png" />
    <form id="password-form" method="POST" action="/password/email">
    {!! csrf_field() !!}
        <div class="login-form-main-message">
            @if ($errors->any())
                {{ implode('', $errors->all(':message')) }}
            @endif
        </div>
        <div class="status">
            {{
             Session::get('message')
           }}
        </div>


            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="email" class="sr-only">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                    </div>
                </div>
            </div>

            <div class="large-button">
                <button type="submit">
                    Reestablecer contraseña
                </button>
            </div>
        <p class="formInfo">
            Se te enviará un correo con un enlace para reestablecer la contraseña.
        </p>

    </form>
    </div>
    </div>
@endsection