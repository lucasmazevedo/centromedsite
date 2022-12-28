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

    <div class="card mb-5 mb-xl-10">
										<div class="card-body pt-9 pb-0">
											<!--begin::Details-->
											<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
												<!--begin::Info-->
												<div class="flex-grow-1">
													<!--begin::Title-->
													<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
														<!--begin::User-->
														<div class="d-flex flex-column">
															<!--begin::Name-->
															<div class="d-flex align-items-center mb-2">
																<a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ session('empresaAtiva.nome') }}</a>
															</div>
															<!--end::Name-->
														</div>
														<!--end::User-->
														<!--begin::Actions-->
														
														<!--end::Actions-->
													</div>
													<!--end::Title-->
													<!--begin::Stats-->
													<div class="d-flex flex-wrap flex-stack">
														<!--begin::Wrapper-->
														<div class="d-flex flex-column flex-grow-1 pe-8">
															<!--begin::Stats-->
															<div class="d-flex flex-wrap">
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-3 svg-icon-warning me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z" fill="currentColor"/>
                                                                        <path d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z" fill="currentColor"/>
                                                                        </svg>
                                                                        </span>
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="{{$examesP}}"  data-kt-initialized="1">{{$examesP}}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Exames Pendentes</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-3 svg-icon-info me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z" fill="currentColor"/>
                                                                        <path d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z" fill="currentColor"/>
                                                                        </svg>
                                                                        </span>
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="{{ $examesC }}" data-kt-initialized="1">{{ $examesC }}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Exames Capturados</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
																<!--begin::Stat
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	
																	<div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-3 svg-icon-primary me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z" fill="currentColor"/>
                                                                        <path d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z" fill="currentColor"/>
                                                                        </svg>
                                                                        </span>
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="{{ $examesC }}" data-kt-initialized="1">{{ $examesC }}</div>
																	</div>
																	
																	
																	<div class="fw-semibold fs-6 text-gray-400">Exames aguardando laudo</div>
																	
																</div>
																end::Stat-->

                                                                <!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
                                                                    <span class="svg-icon svg-icon-3 svg-icon-success me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z" fill="currentColor"/>
                                                                        <path d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z" fill="currentColor"/>
                                                                        </svg>
                                                                        </span>
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="{{ $examesCL }}" data-kt-initialized="1">{{ $examesCL }}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Exames Laudados</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
                                                                 <!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
                                                                        <span class="svg-icon svg-icon-3 svg-icon-danger me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z" fill="currentColor"/>
                                                                        <path d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z" fill="currentColor"/>
                                                                        </svg>
                                                                        </span>
																		<div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="{{ $examesD }}" data-kt-initialized="1">{{ $examesD }}</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Exames Cancelados</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::Wrapper-->
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Info-->
											</div>
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                
                                                <form id="filterRelatorio" method="get" action="{{ route('relatorios.pdf') }}">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-4">
                                                            <label for="exampleFormControlInput1" class="form-label">Filtrar por:</label><br>
                                                            <label class="kt-radio kt-radio--solid">
                                                                <input id="tipo_filtro" class="custom-control-input" checked="checked" name="tipo_filtro" type="radio" value="exame"> Data do Exame
                                                                <span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </label>
                                                            <label class="kt-radio kt-radio--solid">
                                                                <input id="tipo_filtro" class="custom-control-input" name="tipo_filtro" type="radio" value="laudo"> Data do Laudo
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="mb-3">
                                                                <label id="labelDt" for="kt_daterangepicker_3" class="form-label">Data do Exame</label>
                                                                <input id="kt_daterangepicker_3" name="dt_filtro" type="text" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                                <label for="exampleFormControlInput1" class="form-label">Status</label>
                                                                <select name="status" class="form-control" id="select_status">
                                                                    <option value="0" selected="selected">Todos</option>
                                                                    <option value="1">Capturados</option>
                                                                    <option value="3">Laudados</option>
                                                                </select>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <button type="submit" class="btn btn-primary mt-8" id="kt_account_profile_details_submit">Gerar Relatório</button>
                                                        </div>
                                                        
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
											<!--end::Details-->
										</div>
</div>
    </div>
</div>
@endsection

@push('js_custom')
<script>
    $("#kt_daterangepicker_3").daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Selecionar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Até",
            "toLabel": "De",
            "customRangeLabel": "Custom",
            "weekLabel": "S",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        },
    });

    $("#kt_daterangepicker_2").daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Selecionar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Até",
            "toLabel": "De",
            "customRangeLabel": "Custom",
            "weekLabel": "S",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        },
    });


    // $(document).ready(function(){
        $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        console.log(inputValue);
        if(inputValue == "laudo")
        {
            $("#labelDt").text("Data do Laudo");
        }else{
            $("#labelDt").text("Data do Exame");
        }
        // $(".tipol").not(targetBox).hide();
        // $(targetBox).show();
    });
// });
</script>
@endpush