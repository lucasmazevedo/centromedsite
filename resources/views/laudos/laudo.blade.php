@extends('layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Módulo de Laudo</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Gerenciar a edição e assinatura de Laudo</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <button type="submit" form="formLaudo" class="btn btn-sm fw-bold btn-success me-2"> <i class="bi bi-save"></i> Salvar e Assinar</button>
            <a href="{{ route('laudos.index') }}" class="btn btn-sm fw-bold btn-danger me-2"><i class="bi bi-x-square-fill"></i> Voltar</a>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label class="form-label">Paciente:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ $exame->paciente->nome }}" disabled>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data Nascimento:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $exame->paciente->dtnascimento)->format('d/m/Y') }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sexo:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ $exame->paciente->generoPaciente($exame->paciente->sexo) }}" disabled>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">CPF:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ $exame->paciente->cpf }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Exame:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ $exame->nome }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Modalidade:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ $exame->modalidade->abbr }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Data:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid mb-3" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $exame->data)->format('d/m/Y - H:i') }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <form id="formLaudo" action="{{ route('laudos.gravar', $exame->id) }}" method="POST">
                        {{-- <form id="formLaudoAssina" action="{{ route('laudos.salvarAssinar', $exame->id) }}" method="POST"> --}}
                            @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="kt_docs_tinymce_basic" name="kt_docs_tinymce_basic" class="tox-target">
                                    @if($exame->laudo)
                                        {{ $exame->laudo->conteudo }}
                                    @endif
                                </textarea>
                            </div>
                        </form>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header align-items-center">
                        <div class="card-title">
                            <h2>Imagens do Exame ({{ $exame->imagens->count() }})</h2>
                            <hr>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($exame->imagens as $imagem)
                            <div class="col-lg-4 col-md-6  mb-2">
                                    <div class="overlay">
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}">
                                        <!--begin::Image-->
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded">
                                            <img src="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}" class="rounded w-100" alt="">
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Link-->
                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                            <i class="bi bi-eye-fill text-white fs-3x"></i>
                                            {{-- <a data-fslightbox="lightbox-basic" href="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}" class="btn btn-sm btn-danger btn-shadow"><i class="bi bi-eye"></i></a> --}}
                                        </div>
                                        </a>
                                        <!--end::Link-->
                                </div>
                                {{-- <a class="d-block overlay" data-fslightbox="lightbox-basic" href="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style='background-image:url("data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}")'>
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                    </div>
                                    <!--end::Action-->
                                </a> --}}
                            </div>
                            @endforeach
                        </div>

                        <!--end::Overlay-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css_plugins')
@endpush
@push('js_plugins')
<script src="{{ asset('/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script src="{{ asset('/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
@endpush

@push('js_custom')
<script>

var mascaras = [];
if ( KTThemeMode.getMode() === "dark" ) {
    options["skin"] = "oxide-dark";
    options["content_css"] = "dark";
}

tinymce.init({
  selector: '#kt_docs_tinymce_basic',
  height: 480,
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
  toolbar1: 'customInsertButton | insertfile undo redo | campos | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | link image',
  //toolbar2: 'print preview media | forecolor backcolor emoticons',
  //image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
  ],

  setup: function (editor) {
    /* Menu items are recreated when the menu is closed and opened, so we need
       a variable to store the toggle menu item state. */
    var toggleState = false;

    /* example, adding a toolbar menu button */
    editor.ui.registry.addMenuButton('customInsertButton', {
      text: 'Modelos de Laudos',
      fetch: function (callback) {
        var items = [
        @foreach($mascaras as $m)
          {
            type: 'menuitem',
            text: '{{ $m->nome }}',
            onAction: function () {
              editor.setContent('{!! $m->conteudo !!}');
            }
          },
          @endforeach
        ];
        callback(items);
      }
    });

  }
});
</script>
@endpush
