@extends('layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Perfil do Usuário</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Gerenciar os dados do Usuário</li>
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
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Detalhes ({{ $user->name }})</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="formUser" method="POST" action="{{ route('usuarios.perfilupdate') }}" enctype="multipart/form-data" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <div class="form-group col-md-6">
                                <label class="fw-semibold fs-6 required mb-2" for="nome">Nome Completo</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="nome" name="name" placeholder="Nome completo" value="{{ $user->name }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="fw-semibold fs-6 required mb-2" for="email">Email</label>
                                <input type="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="email" name="email" placeholder="Endereço de Email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <!--end::Input group-->

                        <div class="row mb-6">
                            <div class="form-group col-md-6">
                                <label class="fw-semibold fs-6 required mb-2" for="username">Nome de Usuário</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="username" name="username" placeholder="Nome de Usuário" value="{{ $user->username }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="fw-semibold fs-6 required mb-2" for="email">Sexo</label>
                                <select name="sexo" id="sexo" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    <option value="0" @if($user->sexo == 0) selected @endif>Masculino</option>
                                    <option value="1" @if($user->sexo == 1) selected @endif>Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <div class="form-group col-md-6">
                                <label class="fw-semibold fs-6 required mb-2" for="password">Senha</label>
                                <input type="password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="password" name="password">
                                <small id="emailHelp" class="form-text text-muted">Caso não queira mudar a senha, deixar em branco</small>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-6">
                            <div class="form-group col-md-4">
                                <label class="fw-semibold fs-6 required mb-2" for="password">Assinatura</label><Br>
                                <!--begin::Image input-->
                                @if($user->assinatura)
                                <div class="image-input" data-kt-image-input="true" style="background-image: url({{ asset('/assets/media/svg/avatars/blank.svg') }})">
                                    <div class="image-input-wrapper w-250px h-125px" style="background-image: url({{ asset('/storage/' . $user->assinatura) }})"></div>
                                    @else
                                    <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{ asset('/assets/media/svg/avatars/blank.svg') }})">
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
                                        <input type="file" name="assinatura" accept=".png, .jpg, .jpeg" />
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
                                <textarea id="assinaturaRodape" name="assinaturaRodape" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                                    {{ $user->assinaturaRodape }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Salvar</button>
                    </div>
                    <!--end::Actions-->
                <input type="hidden"></form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div>
@endsection

@push('js_custom')
<script src="{{ asset('/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>

<script type="text/javascript">
    tinymce.init({
  selector: '#assinaturaRodape',
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
