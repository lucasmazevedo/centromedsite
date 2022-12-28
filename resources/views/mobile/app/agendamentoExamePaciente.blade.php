@extends('mobile.layouts.app')
@section('content')
    <div class="page__content">
        <h2 class="page__title">Agendamento Data: <b>{{ \Carbon\Carbon::parse($agenda->data_agenda)->format('d/m/Y') }}</b>
        </h2>
        <p class="welcome">
            Paciente: <b>{{ $paciente->nome }}</b><br>
            Data de Nascimento: <b>{{ \Carbon\Carbon::parse($paciente->dtnascimento)->format('d/m/Y') }}</b><br>
            CPF: <b>{{ $paciente->cpf }}</b>
        </p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h3 class="pb-20 pt-20">Dados do Exame</h3>
        <div class="form">
            <form id="Form" method="post" action="{{ route('app.agendamento.store') }}">
                @csrf
                <input type="hidden" name="paciente" value="{{ $paciente->id }}">
                <input type="hidden" name="agenda" value="{{ $agenda->id }}">

                <div class="form__row">
                    <input type="text" name="exame" value="" class="form__input required"
                        placeholder="Nome do Procedimento" />
                </div>

                <h3 class="pb-20 pt-20">Modalidade</h3>
                @foreach ($modalidades as $m)
                    <div class="radio-option">
                        <input type="radio" name="modalidade" id="op4" value="{{ $m->abbr }}" checked /><label
                            for="op4">{{ $m->nome }} ({{ $m->abbr }})</label>
                    </div>
                @endforeach

                <div class="form__row mt-40">
                    <input type="submit" name="submit" class="form__submit button button--green button--full"
                        id="submit" value="CADASTRAR" />
                </div>
            </form>
        </div>
    </div>


@endsection
