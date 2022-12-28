@extends('mobile.layouts.app')
@section('content')
    <div class="page__content">

        <h2 class="page__title">Agendamentos Realizados</h2>

        {{-- <p class="welcome">
            Create nice tables with this custom made table style designs. Longer tables are supported, have scrollable
            content, and can have up to 10 columns.
        </p> --}}

        <div class="table--3cols mb-20 table">
            <div class="table__row">
                <div class="table__section table__section--grow table__section--header">Dados</div>
                <div class="table__section table__section--header">Data</div>
            </div>
            @foreach ($agendamentos as $a)
                <div class="table__row">
                    <div class="table__section table__section--grow"><b>{{ $a->nome }}</b><br>Paciente:
                        <b>{{ $a->paciente->nome }}</b>
                    </div>
                    <div class="table__section">{{ \Carbon\Carbon::parse($a->data)->format('d/m/Y') }}</div>
                </div>
            @endforeach
        </div>

        <h3>Total: {{ $agendamentos->count() }} Agendamentos</h3>
        <h3>Repasse do Mês: {{ $repasse }}</h3>
    </div>
@endsection
