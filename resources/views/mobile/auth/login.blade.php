@extends('mobile.layouts.auth')

@section('content')
    <div class="login__content">
        <h2 class="login__title">Acesso ao Sistema</h2>
        <div class="login-form">
            <form id="LoginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-form__row">
                    <label class="login-form__label">Usuário</label>
                    <input type="text" placeholder="Digite seu usuário" id="username" name="username"
                        class="login-form__input required form-control @error('username') is-invalid @enderror bg-transparent"
                        value="{{ old('username') }}" required autocomplete="username" autofocus />
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="login-form__row">
                    <label class="login-form__label">Password</label>
                    <input id="password" type="password" placeholder="Digite sua senha" name="password"
                        class="login-form__input required form-control @error('password') is-invalid @enderror bg-transparent"
                        required autocomplete="current-password" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="login-form__row">
                    <input type="submit" name="submit" class="login-form__submit button button--blue button--full"
                        id="submit" value="Entrar" />
                </div>
            </form>
        </div>
    </div>
@endsection
