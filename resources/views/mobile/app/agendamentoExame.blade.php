@extends('mobile.layouts.app')
@section('content')
    @extends('mobile.layouts.app')
@section('content')
    <div class="page__content">
        <h2 class="page__title">Agendamento Data: <b>{{ \Carbon\Carbon::parse($agenda->data_agenda)->format('d/m/Y') }}</b>
        </h2>
        @if ($errors->any())
            <div class="cards cards--alert">
                <div class="card">
                    <div class="card__details">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    <div class="card__icon"><img src="{{ asset('/mobile/assets/images/icons/gradient-green/alert.svg') }}"
                            alt="" title="" /></div>
                </div>
            </div>
        @endif
        <div class="form">
            <form id="Form" method="post" action="{{ route('app.agendamento.storePaciente') }}">
                @csrf
                <h3 class="pb-20 pt-20">Dados do Paciente</h3>
                <div class="form__row">
                    <input type="text" name="pNome" value="" class="form__input required"
                        placeholder="Nome do Paciente" />
                </div>

                <div class="form__row">
                    <input type="text" id="pNascimento" name="pNascimento" value="" class="form__input required"
                        placeholder="Data de Nascimento do Paciente" />
                </div>

                <div class="form__row">
                    <input type="text" id="pCpf" name="pCpf" value="" class="form__input required"
                        placeholder="CPF do Paciente" />
                </div>

                <div class="form__row">
                    <div class="form__select">
                        <select name="pSexo" class="required">
                            <option value="" disabled selected>Selecione o Sexo do Paciente</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                </div>


                <h3 class="pb-20 pt-20">Dados do Exame</h3>
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
