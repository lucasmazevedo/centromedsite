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
        <h2 class="page__title">Novo Agendamento</h2>
        <p class="welcome">
            Selecione o dia para realizar o agendamento
        </p>
        <div class="cards cards--11">
            @foreach ($agendas as $agenda)
                <div class="card">
                    <div class="card__details">
                        <h4 class="card__title">Dia {{ \Carbon\Carbon::parse($agenda->data_agenda)->format('d/m/Y') }}
                            @php
                                $agendaData = \App\Models\Exame::where('data', '=', $agenda->data_agenda)->count();
                                
                                $vagas = intval($agenda->vagas) - intval($agendaData);
                                
                            @endphp
                            ({{ $vagas }}
                            Vagas)
                        </h4>
                    </div>
                    <div class="card__more"><a class="button button--white button--ex-small"
                            href="{{ route('app.agendamento.paciente', $agenda->id) }}">-></a>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection
