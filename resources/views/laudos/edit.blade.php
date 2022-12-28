    <div class="modal-header">
        <h2>Editar Exame ({{ $exame->nome }})</h2>
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
                <div class="row mb-10 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                        <span class="required">Exame</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" value="{{ $exame->nome }}" placeholder="" name="nome">
                </div>
                <div class="row mb-10">
                    <div class="row mb-10 fv-row fv-plugins-icon-container">
                        <div class="col-6">
                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                <span class="required">Modalidade</span>
                            </label>
                            <select name="modalidade" id="modalidade" class="form-select form-select-solid">
                                @foreach ($modalidades as $modalidade)
                                    <option @if($exame->modalidade_id == $modalidade->id) selected="selected" @endif value="{{ $modalidade->id }}">{{ $modalidade->nome }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-6">
                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                <span class="required">Data do Exame</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" value="{{ \Carbon\Carbon::parse($exame->data)->format('d/m/Y h:i') }}" placeholder="" name="data" id="dataExame">
                        </div>
                    </div>
                </div>
                <div class="text-center pt-15">
                    <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Cancelar</button>
                    <button type="button" data-attr="{{ route('exames.update', $exame->id) }}" id="btn-edit-send" class="btn btn-primary me-3">Salvar</button>
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
            "mask" : "99/99/9999 99:99",
        }).mask("#dataExame");
</script>

