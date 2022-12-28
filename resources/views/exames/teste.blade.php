@extends('layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Módulo de Exames</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Gerenciar os exames do sistema</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        
        <div class="card">
            <div id="results" class="card-header border-0 pt-6">
            </div>
            <div class="card-body">
                <div class="d-flex align-items-sm-center mb-5 fb-row">
                    <div class="symbol symbol-45px me-4">
                        <span class="symbol symbol-25px me-3">
                            <span class="badge py-3 px-4 fs-7 badge-light-primary"><i class="bi bi-person-fill fs-2 text-primary"></i></span>
                        </span>
                    </div>
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <span class="text-gray-800 d-block fs-4">Paciente: <span class="fw-bold" id='nomePaciente'></span></span>
                            <span class="text-gray-800 fs-6">Data Nascimento: <span class="fw-bold" id="nascimentoPaciente"></span> - CPF: <span id='cpfPaciente' class="fw-bold"></span></span>
                        </div>
                        <span class="badge badge-lg badge-light-primary fw-bold my-2">Novo</span>
                        {{-- <span class="badge badge-lg badge-light-primary fw-bold my-2">Cadastrado</span> --}}
                    </div>
                </div>
                <div class="timeline fv-row">
                    <div class="separator separator-dashed my-6"></div>
                    <div id="exames"></div>
                    {{-- <div class="timeline-item align-items-center mb-7">
                        <div class="timeline-icon" style="margin-left: 11px">
                            <span class="badge badge-lg badge-light-primary fw-bold my-2">US</span>
                        </div>
                        <div class="timeline-content m-0">
                            <span class="fs-6 text-gray-800 d-block">Procedimento: <span class="fw-bold">USG ABDOMEN</span></span>
                            <span class="fs-6 text-gray-800">Data: <span class="fw-bold">08/09/2022 às 16:00h</span></span>
                        </div>
                    </div> --}}
                    {{-- <div class="timeline-item align-items-center">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon" style="margin-left: 11px">
                            <span class="badge badge-lg badge-light-primary fw-bold my-2">US</span>
                        </div>
                        <div class="timeline-content m-0">
                            <span class="fs-6 text-gray-800 d-block">Procedimento: <span class="fw-bold">USG ABDOMEN</span></span>
                            <span class="fs-6 text-gray-800">Data: <span class="fw-bold">08/09/2022 às 16:00h</span></span>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js_custom')

<script>
$(function () {
    var data = {    
        "paciente": "1", 
        "nome": "Lucas Martins de Azevedo",
        "cpf": "033.474.683-33",
        "dtnascimento": "27/05/1988",
        "sexo": "M",
        "exames_repeater[0][exame]": "USG ABDOMEM",
        "exames_repeater[0][data]": "08/09/2022 16:00",
        "exames_repeater[0][modalidade]": "US",
        "exames_repeater[1][exame]": "USG TORAX", 
        "exames_repeater[1][data]": "08/09/2022 16:00",
        "exames_repeater[1][modalidade]": "OT" 
    }

    var exameData = { 
        "exames_repeater": [ 
            { "exame": "USG ABDOMEM", "data": "21/31/2312 31:31", "modalidade": "US" },
            { "exame": "USG TORAX", "data": "12/31/2312 33:12", "modalidade": "US" } 
        ] 
    }

  
    
    $('#nomePaciente').html(data.nome);
    $('#nascimentoPaciente').html(data.dtnascimento)
    $('#cpfPaciente').html(data.cpf);

    var template = '';
    exameData.exames_repeater.forEach(element => {
        template += '<div class="timeline-item align-items-center mb-7">';
        template += '<div class="timeline-icon" style="margin-left: 11px">'
        template += '<span class="badge badge-lg badge-light-primary fw-bold my-2">' + element.modalidade + '</span>'
        template += '</div>'
        template += '<div class="timeline-content m-0">'
        template += '<span class="fs-6 text-gray-800 d-block">Procedimento: <span class="fw-bold">' + element.exame + '</span></span>'
        template += '<span class="fs-6 text-gray-800">Data: <span class="fw-bold">' + element.data + '</span></span>'
        template += '</div>'
        template += '</div>'
    });
    var divExames = document.getElementById('exames');
    divExames.innerHTML = template;
});

</script>
    
@endpush