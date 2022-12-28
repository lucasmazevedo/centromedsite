    <div class="modal-header">
        <h2>Cadastrar Novo Exame</h2>
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
            <span class="svg-icon svg-icon-1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                        transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                </svg>
            </span>
        </div>
    </div>
    <div class="modal-body py-lg-10 px-lg-10">
        <!--begin::Stepper-->
        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-lg-row" id="stepper_cadastro_exame">
            <!--begin::Aside-->
            <div class="d-flex flex-row-auto w-100 w-lg-300px">
                <!--begin::Nav-->
                <div class="stepper-nav flex-cente">
                    <!--begin::Step 1-->
                    <div class="stepper-item me-5 current" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">1</span>
                            </div>
                            <!--end::Icon-->

                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Paciente
                                </h3>

                                <div class="stepper-desc">
                                    Selecione o Paciente
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    <div class="stepper-item me-5" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <!--begin::Icon-->

                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Exames
                                </h3>
                                <div class="stepper-desc">
                                    Insira os exames do paciente
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    <div class="stepper-item me-5" data-kt-stepper-element="nav">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Icon-->
                            <div class="stepper-icon w-40px h-40px">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">3</span>
                            </div>
                            <!--begin::Icon-->

                            <!--begin::Label-->
                            <div class="stepper-label">
                                <h3 class="stepper-title">
                                    Revisão
                                </h3>

                                <div class="stepper-desc">
                                    Revise as informações inseridas
                                </div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 3-->
                </div>
                <!--end::Nav-->
            </div>

            <!--begin::Content-->
            <div class="flex-row-fluid">
                <!--begin::Form-->
                <form class="form w-lg-100 mx-auto" id="formCadastrarExame" name="formCadastrarExame"
                    novalidate="novalidate">
                    <!--begin::Group-->
                    <div class="mb-5">
                        <!--begin::Step 1-->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input id="novoPaciente" name="pacienteNovo" class="form-check-input"
                                        type="checkbox" value="1" />
                                    <span class="form-check-label">
                                        Novo Paciente
                                    </span>
                                </label>
                                <!--end::Switch-->
                            </div>
                            <div id="form_seleciona_paciente">
                                <div class="fv-row mb-10">
                                    <label class="form-label">Paciente</label>
                                    <div class="rounded border">
                                        <select id="kt_docs_select2_rich_content" class="form-select form-select-solid"
                                            name="paciente" data-placeholder="Selecione o paciente">
                                            <option></option>
                                            @foreach ($pacientes as $paciente)
                                                <option value="{{ $paciente->id }}"
                                                    data-kt-rich-content-subcontent="Data Nascimento: {{ \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->dtnascimento)->format('d/m/Y') }}
                                        ">
                                                    {{ $paciente->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="display: none;" id="feedbackSelectPaciente"
                                        class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="text_input" data-validator="notEmpty">Selecione um Paciente ou
                                            Cadastre um Novo</div>
                                    </div>
                                </div>
                            </div>
                            <div id="form_novo_paciente" style="display: none;">
                                <div class="row mb-5">
                                    <div class="col-8">
                                        <label class="fs-6 fw-semibold form-label"><span class="required">Nome do
                                                Paciente</span></label>
                                        <input type="text" class="form-control form-control-solid" name="nome"
                                            value="" />
                                        <div id="campoNomeFb" class="invalid-feedback">Nome é obrigatório!</div>
                                    </div>
                                    <div class="col-4">
                                        <label class="fs-6 fw-semibold form-label"><span>CPF</span></label>
                                        <input type="text" class="form-control form-control-solid mask_cpf"
                                            name="cpf" value="" />
                                        <div id="campoNomeFb" class="invalid-feedback">CPF é obrigatório!</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fs-6 fw-semibold form-label"><span class="required">Data de
                                                Nascimento</span></label>
                                        <input type="text" class="form-control form-control-solid mask_date"
                                            name="dtnascimento" value="" />
                                        <div id="campoNomeFb" class="invalid-feedback">Data de Nascimento é
                                            obrigatória!</div>
                                    </div>
                                    <div class="col-6">
                                        <label class="fs-6 fw-semibold form-label"><span>Sexo</span></label>
                                        <select name="sexo" class="form-select form-select-solid"
                                            aria-label="Select example">
                                            <option value="">-- Selecione uma opção --</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                        <div id="campoNomeFb" class="invalid-feedback">Sexo é obrigatório!</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">

                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="exames_repeater">
                                        <div data-repeater-item>
                                            <div class="form-group row mb-4">
                                                <div class="col-md-5">
                                                    <label class="form-label">Exame:</label>
                                                    <input type="text" name="exame"
                                                        class="form-control form-control-solid mb-md-0 mb-2"
                                                        placeholder="Nome do Procedimento" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Data:</label>
                                                    <input type="text" name="data"
                                                        data-kt-repeater="mask_datetime"
                                                        class="form-control form-control-solid mb-md-0 mask_datetime mb-2"
                                                        value="{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}"
                                                        placeholder="Data do Exame" />
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Modalidade:</label>
                                                    <select name="modalidade" class="form-select form-select-solid"
                                                        aria-label="Select example">
                                                        <option value="">-- Selecione uma opção --</option>
                                                        <option value="US">US</option>
                                                        <option value="OT">OT</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="javascript:;" data-repeater-delete
                                                        class="btn btn-icon btn-sm btn-light-danger mt-md-8 mt-3">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="form-group mt-5">
                                    <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                        <i class="la la-plus"></i> Exame
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->
                        </div>
                        <!--begin::Step 1-->

                        <!--begin::Step 1-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="d-flex align-items-sm-center fb-row mb-5">
                                <div class="symbol symbol-45px me-4">
                                    <span class="symbol symbol-25px me-3">
                                        <span class="badge fs-7 badge-light-primary py-3 px-4"><i
                                                class="bi bi-person-fill fs-2 text-primary"></i></span>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <div class="flex-grow-1 me-2">
                                        <span class="d-block fs-4 text-gray-800">Paciente: <span class="fw-bold"
                                                id="nomePaciente"></span></span>
                                        <span class="fs-6 text-gray-800">Data Nascimento: <span class="fw-bold"
                                                id="nascimentoPaciente"></span> - CPF: <span id='cpfPaciente'
                                                class="fw-bold"></span></span>
                                    </div>
                                    <span id="labelNovoPaciente"
                                        class="badge badge-lg badge-light-primary fw-bold my-2"></span>
                                </div>
                            </div>
                            <div class="timeline fv-row">
                                <div class="separator separator-dashed my-6"></div>
                                <div id="exames"></div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-stack">
                        <div class="me-2">
                            <button type="button" class="btn btn-light btn-active-light-primary"
                                data-kt-stepper-action="previous">
                                Voltar
                            </button>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" data-kt-stepper-action="submit">
                                <span class="indicator-label">
                                    Cadastrar
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span
                                        class="spinner-border spinner-border-sm ms-2 align-middle"></span>
                                </span>
                            </button>

                            <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                Avançar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        Inputmask({
            "mask": "999.999.999-99",
        }).mask(".mask_cpf");


        Inputmask({
            "mask": "99/99/9999",
        }).mask(".mask_date");

        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,

            defaultValues: {
                'data': moment().format('DD/MM/YYYY HH:mm')
            },

            show: function() {
                $(this).slideDown();

                new Inputmask({
                    "mask": "99/99/9999 99:99",
                }).mask("[data-kt-repeater='mask_datetime']");

            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {

                Inputmask({
                    "mask": "99/99/9999 99:99",
                }).mask("[data-kt-repeater='mask_datetime']");
            }
        });

        // Format options
        var optionFormat = (item) => {
            if (!item.id) {
                return item.text;
            }

            var span = document.createElement('span');
            var template = '';

            template += '<div class="d-flex align-items-center">';
            template += '<div class="d-flex flex-column">'
            template += '<span class="fs-5 fw-bold lh-1">' + item.text + '</span>';
            template += '<span class="text-muted fs-6">' + item.element.getAttribute(
                'data-kt-rich-content-subcontent') + '</span>';
            template += '</div>';
            template += '</div>';

            span.innerHTML = template;

            return $(span);
        }

        $('#kt_docs_select2_rich_content').select2({
            dropdownParent: $('#kt_modal_xl'),
            placeholder: "Select an option",
            // minimumResultsForSearch: Infinity,
            templateSelection: optionFormat,
            templateResult: optionFormat
        });

        var element = document.querySelector("#stepper_cadastro_exame");
        var stepper = new KTStepper(element);
        stepper.on("kt.stepper.next", function(stepper) {

            if (stepper.getCurrentStepIndex() == 1) {
                var novoPaciente = $("#novoPaciente");
                var campoPacienteNome = $("input[name=nome]");
                var PacienteNomeValid = false;
                var PacienteDtnascimento = false;
                var PacienteSexo = false;
                var campoPacienteDtnascimento = $("input[name=dtnascimento]");
                var campoPacienteSexo = $("select[name=sexo]");
                var campoPacienteSelect = $('#kt_docs_select2_rich_content');
                var feedbackPacienteSelect = $('#feedbackSelectPaciente');
                if (novoPaciente.is(':checked')) {
                    if (campoPacienteNome.val() == "") {
                        campoPacienteNome.removeClass("is-valid").addClass("is-invalid");
                    } else {
                        PacienteNomeValid = true;
                        campoPacienteNome.removeClass("is-invalid").addClass("is-valid");
                    }
                    if (campoPacienteDtnascimento.val() == "") {
                        campoPacienteDtnascimento.removeClass("is-valid").addClass("is-invalid");
                    } else {
                        campoPacienteDtnascimento.removeClass("is-invalid").addClass("is-valid");
                        PacienteDtnascimento = true;
                    }

                    if (campoPacienteSexo.val() == "") {
                        campoPacienteSexo.removeClass("is-valid").addClass("is-invalid");
                    } else {
                        campoPacienteSexo.removeClass("is-invalid").addClass("is-valid");
                        PacienteSexo = true;
                    }

                    if (PacienteNomeValid == true && PacienteDtnascimento == true && PacienteSexo == true) {
                        stepper.goNext();
                    }
                } else {

                    if (campoPacienteSelect.val() == "") {
                        feedbackPacienteSelect.show();
                    } else {
                        feedbackPacienteSelect.hide();
                        stepper.goNext();
                    }
                }
            }

            if (stepper.getCurrentStepIndex() == 2) {
                var exames = $('#kt_docs_repeater_basic').repeaterVal();
                var validadeExames = 0;
                var countExames = exames.exames_repeater.length;
                exames.exames_repeater.forEach((element, index) => {
                    if (element.exame == "") {
                        var field = $("input[name='exames_repeater[" + index + "][exame]']");
                        field.removeClass("is-valid").addClass("is-invalid");
                    } else {
                        var field = $("input[name='exames_repeater[" + index + "][exame]']");
                        field.removeClass("is-invalid").addClass("is-valid");
                    }
                    if (element.modalidade == "") {
                        var field = $("select[name='exames_repeater[" + index + "][modalidade]']");
                        field.removeClass("is-valid").addClass("is-invalid");
                    } else {
                        var field = $("select[name='exames_repeater[" + index + "][modalidade]']");
                        field.removeClass("is-invalid").addClass("is-valid");
                    }
                    if (element.data == "") {
                        var field = $("input[name='exames_repeater[" + index + "][data]']");
                        field.removeClass("is-valid").addClass("is-invalid");
                    } else {
                        var field = $("input[name='exames_repeater[" + index + "][data]']");
                        field.removeClass("is-invalid").addClass("is-valid");
                    }

                    if (!element.exame == "" && !element.modalidade == "" && !element.data == "") {
                        validadeExames = validadeExames + 1;
                    }
                });
                if (validadeExames == countExames) {
                    stepper.goNext();
                }


            }

            if (stepper.getCurrentStepIndex() == 3) {
                var form = $('#formCadastrarExame').serializeArray();
                o = {};
                form.forEach(function(v) {
                    if (!o[v.name]) {
                        o[v.name] = v.value;
                    } else {
                        o[v.name] = [o[v.name]];
                        o[v.name].push(v.value);
                    };
                });
                var examesData = $('#kt_docs_repeater_basic').repeaterVal()

                if (o.pacienteNovo) {
                    $('#labelNovoPaciente').text("NOVO");
                    $('#nomePaciente').html(o.nome);
                    $('#nascimentoPaciente').html(o.dtnascimento)
                    $('#cpfPaciente').html(o.cpf);
                } else {
                    var paciente = o.paciente;
                    var base_path = "https://localhost/cmcapture/public";
                    $.ajax({
                        url: '/paciente/' + paciente + '/dados',
                        method: 'GET',
                        success: function(response) {
                            $('#labelNovoPaciente').text("JÁ CADASTRADO");
                            $('#nomePaciente').html(response.data.nome);
                            $('#nascimentoPaciente').html(moment(response.data.dtnascimento,
                                "YYYY-MM-DD").format('DD/MM/YYYY'));
                            $('#cpfPaciente').html(response.data.cpf.match(/.{1,3}/g).join(".").replace(
                                /\.(?=[^.]*$)/, "-"));
                        }
                    });

                }

                var template = '';
                examesData.exames_repeater.forEach(element => {
                    template += '<div class="timeline-item align-items-center mb-7">';
                    template += '<div class="timeline-icon" style="margin-left: 11px">'
                    template += '<span class="badge badge-lg badge-light-primary fw-bold my-2">' + element
                        .modalidade + '</span>'
                    template += '</div>'
                    template += '<div class="timeline-content m-0">'
                    template +=
                        '<span class="fs-6 text-gray-800 d-block">Procedimento: <span class="fw-bold">' +
                        element.exame + '</span></span>'
                    template += '<span class="fs-6 text-gray-800">Data: <span class="fw-bold">' + element
                        .data + '</span></span>'
                    template += '</div>'
                    template += '</div>'
                });
                var divExames = document.getElementById('exames');
                divExames.innerHTML = template;
            };
        });
        stepper.on("kt.stepper.previous", function(stepper) {
            stepper.goPrevious();
        });

        $('#novoPaciente').on('change', function() {
            if ($(this).is(':checked')) {
                $("#form_seleciona_paciente").hide();
                $("#form_novo_paciente").show();

            } else {
                $("#form_seleciona_paciente").show();
                $("#form_novo_paciente").hide();
            }
        });


        $('[data-kt-stepper-action="submit"]').click(function() {
            var examesData = $('#kt_docs_repeater_basic').repeaterVal()
            var form = $('#formCadastrarExame').serializeArray();
            // var exameCreateData = {};
            o = {};
            form.forEach(function(v) {
                if (!o[v.name]) {
                    o[v.name] = v.value;
                } else {
                    o[v.name] = [o[v.name]];
                    o[v.name].push(v.value);
                };
            });

            if (o.pacienteNovo) {
                var exameDataCreate = {
                    "pacienteNome": o.nome,
                    "pacienteCPF": o.cpf,
                    "pacienteDtNascimento": o.dtnascimento,
                    "pacienteSexo": o.sexo,
                    "exames": examesData.exames_repeater
                };
            } else {
                var exameDataCreate = {
                    "pacienteId": o.paciente,
                    "exames": examesData.exames_repeater
                };
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('exames.create') }}",
                method: 'POST',
                data: exameDataCreate,
                success: function(data, textStatus, xhr) {
                    if (xhr.status == 200) {
                        toastr.success(data.success, "Tudo certo!");
                        $('#modal-content-xl').html();
                        $('#kt_modal_xl').modal('hide');
                    } else {
                        toastr.error("Ocorreu um erro, tente novamente!", "Ops.. Aconteceu algo!");
                    }
                },
                complete: function(xhr, textStatus) {}
            });

        });
    </script>
