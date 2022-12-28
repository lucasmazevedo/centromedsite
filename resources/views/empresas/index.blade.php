@extends('layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Empresas</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Selecione uma empresa para continuar</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a> --}}
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row">
            @foreach($empresas as $empresa)
            <div class="col-xl-3 mb-xl-3">
                <div class="card card-flush">
                    <div class="card-header pt-5">
                        <h4 class="card-title d-flex align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">{{$empresa->nome}}</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-7">PacsID: {{$empresa->idpacs}}</span>
                        </h4>
                    </div>
                    <div class="card-body pt-6">
                        <div class="mt-n5">
                                <div class="d-flex align-items-center mb-5">
                                    <div class="w-150px flex-shrink-0 me-2">
                                        @if(!$empresa->logo)
                                        <img src="{{ asset("/assets/media/avatars/blank.png") }}" alt="Empresa Logo" width="100px">
                                        @else
                                        <img src="{{ asset($empresa->logo) }}" alt="Empresa Logo" width="150px">
                                        @endif
                                    </div>
                                    <div class="m-0">
                                        <div class="d-flex d-grid gap-5">
                                            <a href="{{ route('empresa.seleciona', $empresa->id) }}" class="btn btn-sm btn-primary">Selecionar Empresa</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
