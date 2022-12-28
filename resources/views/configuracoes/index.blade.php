@extends('layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Módulo de Laudos</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Gerenciar os laudos dos exames do sistema</li>
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
            <div class="card-body p-lg-17">
                <div class="d-flex flex-column flex-lg-row mb-17">
                    <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <!--begin::Form-->
                        <form action="{{ route('configuracoes.update') }}" method="POST" enctype="multipart/form-data" class="form mb-15">
                            @csrf
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="required fs-5 fw-semibold mb-2">Nome da Empresa</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="nome" value="{{ $empresa->nome }}">
                                </div>

                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                    <label class="required fs-5 fw-semibold mb-2">Id do Pacs</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="idpacs" value="{{ $empresa->idpacs }}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <div class="form-group col-md-4">
                                    <label class="fw-semibold fs-6 required mb-2" for="password">Logo</label><Br>
                                    <!--begin::Image input-->
                                    @if($empresa->logo)
                                    <div class="image-input" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                        <div class="image-input-wrapper w-250px h-125px" style="background-image: url({{ asset('/storage/' . $empresa->logo) }})"></div>
                                        @else
                                        <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                        <div class="image-input-wrapper w-250px h-125px"></div>
                                    @endif
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Mudar Assinatura">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Deletar Assinatura">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Deletar Assinatura avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Tipos permitidos: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <div class="form-group col-md-8">
                                    <textarea id="rodape" name="rodape" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                        {{ $empresa->rodape }}
                                    </textarea>
                                </div>
                            </div>
                            <!--end::Separator-->
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                Atualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_custom')
<script src="{{ asset('/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function (e) {
       $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
       });

    });


    tinymce.init({
  selector: '#rodape',
  height: 200,
//   theme: 'modern',
  content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
  menubar: false,
  statusbar: false,
  fontsize_formats: "6pt 7pt 8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt",
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern image imagetools code variable'
  ],
  toolbar1: 'insertfile undo redo | campos | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | link image',
  //toolbar2: 'print preview media | forecolor backcolor emoticons',
  //image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
  ],
});

    </script>

@endpush
