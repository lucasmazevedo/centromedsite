@extends('layouts.auth')

@section('content')
    <div class="card rounded-3 w-md-550px">
        <!--begin::Card body-->
        <div class="card-body p-10 p-lg-20">
            <!--begin::Form-->
            <form class="form w-100" method="POST" action="{{ route('login') }}">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">Acesso ao Sistema</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">Cloudmed Capture</div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <label for="username">Nome de Usuário</label>
                    <input type="text" placeholder="Digite seu usuário" id="username" name="username" class="form-control @error('username') is-invalid @enderror bg-transparent" value="{{ old('username') }}" required autocomplete="username" autofocus />
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--end::Input group=-->
                <div class="fv-row mb-3">
                    <!--begin::Password-->
                    <label for="password">Senha</label>
                    <input id="password" type="password" placeholder="Digite sua senha" name="password" class="form-control @error('password') is-invalid @enderror bg-transparent" required autocomplete="current-password"/>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--end::Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Wrapper-->
                @if (Route::has('password.request'))
                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                    <div></div>
                    <a href="{{ route('password.request') }}" class="link-primary">Esqueceu a senha?</a>
                </div>
                @endif
                <!--end::Wrapper-->
                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Acessar Sistema</span>
                        <!--end::Indicator label-->
                    </button>
                </div>
                <!--end::Submit button-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
