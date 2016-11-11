<!-- resources/views/auth/reset.blade.php -->
@extends('auth')
@section('content')
    <div class="login-wrapper">
    <div class="login-form-wrapper">

        <form class="form-reset" method="POST" action="/password/reset">
            {!! csrf_field() !!}
            <div class="login-form-main-message">
                @if ($errors->any())
                    {{ implode('', $errors->all(':message')) }}
                @endif
            </div>
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email">Email:</label><input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label for="password">Nueva contraseña:</label><input type="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Vuelva a escribir la nueva contraseña:</label><input type="password" name="password_confirmation">
            </div>
            <div class="large-button">
                <button type="submit">
                    Cambiar contraseña
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection