@extends('mobile.layouts.app')
@section('content')
    <div class="user-welcome mb-10">Olá, <strong>{{ Auth::user()->name }}</strong></div>
    <p class="welcome">Bem vindo ao sistema de agendamento da Clínica Centromed</p>

    @if (session('status'))
        <div class="cards cards--alert">
            <div class="card">
                <div class="card__details">
                    <h4 class="card__title mb-10">{{ session('status') }}</h4>
                </div>
                <div class="card__icon"><img src="{{ asset('/mobile/assets/images/icons/gradient-green/alert.svg') }}"
                        alt="" title="" /></div>
            </div>
        </div>
    @endif

    <nav class="nav-medical mb-20">
        <ul>
            <li><a href="{{ route('app.agendamento') }}"><img src="{{ asset('/mobile/assets/images/icons/blue/form.svg') }}"
                        alt="" title="" /><span>Novo Agendamento</span></a></li>
            <li><a href="{{ route('app.mobile.agendamentosR') }}"><img
                        src="{{ asset('/mobile/assets/images/icons/blue/form.svg') }}" alt=""
                        title="" /><span>Consultar Agendamentos</span></a></li>
        </ul>
    </nav>

    <h2 class="page__title">Estatísticas</h2>
    <div class="cards cards--11 mb-20">
        <div class="card">
            <div class="card__details">
                <h4 class="card__title">Total de Agendamentos Realizados</h4>
            </div>
            <div class="card__more"><a class="button button--white button--ex-small">{{ $countAgendamentos }}</a></div>
        </div>
        <div class="card">
            <div class="card__details">
                <h4 class="card__title">Repasses Previstos </h4>
            </div>
            <div class="card__more"><a class="button button--white button--ex-small">{{ $repasse }}</a></div>
        </div>
    </div>
@endsection
