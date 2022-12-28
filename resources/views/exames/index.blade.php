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
            {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a> --}}
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Pesquisar"/>
                    </div>
                    <!--end::Search-->

                    <div class="btn-group w-100 w-lg-150 ms-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        <label class="btn btn-secondary text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                            <input class="btn-check" type="radio" name="filter_exames" checked="checked" value="1"/>
                            Pendentes
                        </label>

                        <label class="btn btn-secondary text-hover-white text-active-white btn-outline btn-active-success " data-kt-button="true">
                            <input class="btn-check" type="radio" name="filter_exames"  value="2"/>
                            Capturados
                        </label>

                        <label class="btn btn-secondary text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                            <input class="btn-check" type="radio" name="filter_exames" value="3" />
                            Cancelados
                        </label>
                    </div>
                </div>

                <div class="card-toolbar">
                    <button data-attr="{{ route('exames.create') }}" type="button" id="btnCadastraExame" class="btn btn-primary">
                        {{-- data-bs-toggle="tooltip" title="Coming Soon" --}}
                        Cadastrar Novo Exame
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <table id="kt_datatable_exames" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th>Cod</th>
                        <th>Dados Paciente</th>
                        <th>Dados Exame</th>
                        <th>Data do Exame</th>
                        <th>Situação do Exame</th>
                        <th class="min-w-100px">Ações</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css_plugins')
    <link href="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        th.dt-center, td.dt-center { text-align: center; }
    </style>
@endpush
@push('js_plugins')
    <script src="{{ asset('/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush

@push('js_custom')
<script>
    $(function () {

        var filterExame = 1;
        var table = $('#kt_datatable_exames').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('exames.index') }}",
                data: function (d) {
                    d.situacao = filterExame;
                }
            },

            language: {
                url: "{{ asset('/assets/plugins/custom/datatables/pt-BR.json') }}"
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'paciente', name: 'paciente.nome'},
                {data: 'nome', name: 'nome'},
                {data: 'data', name: 'data'},
                {data: 'situacao', name: 'situacao'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                        targets: 0,
                        orderable: false,
                        className: "text-center",
                        render: function (data) {
                            return `<span class="text-center badge badge-light-primary fs-base">`+ '0000'.substr( String(data).length ) + data +`</span>`
                        }
                },
                {
                        targets: 1,
                        orderable: false,
                },
                {
                        targets: 2,
                        orderable: false,
                },
                {
                        targets: 3,
                        orderable: false,
                        className: "text-center",
                },
                {
                        targets: 4,
                        orderable: false,
                        className: "text-center",
                },
                {
                        targets: 5,
                        orderable: false,
                        className: "text-end",
                },
            ]
        });

        $('input[type=radio][name=filter_exames]').on('change', function() {
            filterExame = $(this).val();
            table.ajax.reload();
        });


        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            table.search(e.target.value).draw();
        });


        $('body').on('click', '#btnCadastraExame', function(e) {
            e.preventDefault();
            var href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                method: 'GET',
                success: function(result) {
                    $('#modal-content-xl').html(result);
                    $('#kt_modal_xl').modal('show');
                }
            });
        });

        $('#kt_modal_xl').on('hidden.bs.modal', function () {
            table.ajax.reload( null, false );
        });

        $('body').on('click', '#btn-edit-exame', function(e) {
            e.preventDefault();
            var href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                method: 'GET',
                success: function(result) {
                    $('#modal-content-xl').html(result);
                    $('#kt_modal_xl').modal('show');
                }
            });
        });

        $('body').on('click', '#btn-edit-send', function(e) {
            e.preventDefault();
            var href = $(this).attr('data-attr');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: href,
                method: 'POST',
                data: $('form#modal-edit-form').serialize(),
                success: function(data, textStatus, xhr) {
                    if(xhr.status == 200)
                    {
                        toastr.success(data.success, "Tudo certo!");
                        $('#modal-content-xl').html();
                        $('#kt_modal_xl').modal('hide');
                    }else{
                        toastr.error("Ocorreu um erro, tente novamente!", "Ops.. Aconteceu algo!");
                    }
                },
                complete: function(xhr, textStatus) {
                }
            });
        });

        $('body').on('click', '#btn-destroy-exame', function(e) {
            e.preventDefault();
            var href = $(this).attr('data-attr');
            var nExame = $(this).attr('data-exame');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                html: `Deseja cancelar o exame <strong>`+ nExame +`</strong>?`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: false,
                confirmButtonText: "Sim, Cancelar!",
                showDenyButton: true,
                denyButtonText: `Não cancelar`,
                customClass: {
                    confirmButton: "btn btn-primary",
                    denyButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: href,
                        method: 'POST',
                        success: function(data, textStatus, xhr) {
                            if(xhr.status == 200)
                            {
                                toastr.success(data.success, "Tudo certo!");
                                $('#modal-content-xl').html();
                                $('#kt_modal_xl').modal('hide');
                                table.ajax.reload( null, false );
                            }else{
                                toastr.error("Ocorreu um erro, tente novamente!", "Ops.. Aconteceu algo!");
                            }
                        },
                        complete: function(xhr, textStatus) {
                        }
                    });
                } else if (result.isDenied) {
                    toastr.info("Exame não foi cancelado!", "Informação...");
                }
            });
        });

    });
</script>

@endpush
