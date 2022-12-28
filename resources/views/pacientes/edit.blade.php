<div class="modal-header">
    <h2>Editar Paciente ({{ $paciente->nome }})</h2>
    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
        <span class="svg-icon svg-icon-1">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
            </svg>
        </span>
    </div>
</div>
<div class="modal-body py-lg-10 px-lg-10">
    <form id="modal-edit-form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
            <div class="row mb-6">
                <div class="form-group col-md-6">
                    <label class="fw-semibold fs-6 required mb-2" for="nome">Nome do Paciente</label>
                    <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="nome" name="nome" placeholder="Nome completo" value="{{ $paciente->nome }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fw-semibold fs-6 required mb-2" for="email">CPF</label>
                    <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="cpf" name="cpf" placeholder="CPF" value="{{ $paciente->cpf }}">
                </div>
            </div>

            <div class="row mb-6">
                <div class="form-group col-md-6">
                    <label class="fw-semibold fs-6 required mb-2" for="nome">Data de Nascimento</label>
                    <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="dtnascimento" name="dtnascimento" placeholder="" value="{{ \Carbon\Carbon::parse($paciente->dtnascimento)->format('d/m/Y') }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fw-semibold fs-6 required mb-2" for="email">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                        <option value="0" @if($paciente->sexo == 0) selected @endif>Masculino</option>
                        <option value="1" @if($paciente->sexo == 1) selected @endif>Feminino</option>
                    </select>
                </div>
            </div>


            <div class="text-center pt-15">
                <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancelar</button>
                <button type="button" data-attr="{{ route('pacientes.update', $paciente->id) }}" id="btn-edit-send" class="btn btn-primary me-3">Salvar</button>
                {{-- <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                    <span class="indicator-label">Salvar</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button> --}}
            </div>
        </div>
    </form>
</div>
<script>

new Inputmask({
        "mask" : "99/99/9999",
    }).mask("#dtnascimento");

    new Inputmask({
        "mask" : "999.999.999-99",
    }).mask("#cpf");
</script>

