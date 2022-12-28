@extends('mobile.layouts.app')
@section('content')
    <!-- <div class="cards cards--alert">
                                                                                                                                                                                    <div class="card">
                                                                                                                                                                                    <div class="card__details">
                                                                                                                                                                                    <h4 class="card__title mb-10">Stay Home!</h4>
                                                                                                                                                                                    <p>Reduce your risk of infection when they cough, sneeze or speak</p>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <div class="card__icon"><img src="../assets/images/icons/gradient-green/alert.svg" alt="" title=""/></div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                        </div> -->
    <div class="page__content">
        <h2 class="page__title">Selecione o Paciente</h2>
        <p class="welcome">
            Selecione o Paciente para o agendamento do dia
            {{ \Carbon\Carbon::parse($agenda->data_agenda)->format('d/m/Y') }}
        </p>

        <a href="{{ route('app.agendamento.exame', $agenda->id) }}" class="button button--green button--full mb-20">NOVO
            PACIENTE</a>

        <div class="cards cards--11">
            @foreach ($pacientes as $p)
                <div class="card">
                    <div class="card__details">
                        <h4 class="card__title">{{ $p->nome }}<br>
                            {{ \Carbon\Carbon::parse($p->dtnascimento)->format('d/m/Y') }}
                        </h4>
                    </div>
                    <div class="card__more"><a class="button button--white button--ex-small"
                            href="{{ '/mobile/novoAg/' . $agenda->id . '/paciente/exame/' . $p->id . '' }}">></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
