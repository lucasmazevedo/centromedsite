@extends('layouts.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Módulo de Captura</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">Realizar captura de imagens</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body pb-0">
                        <div class="mb-5" id="my_camera">
                            <video id="webcam" autoplay playsinline width="800" height="600" video="100%"
                            style="width:100%, height:600px"></video>
                            <canvas id="canvas" class="d-none"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body pb-0">
                        <div class="mb-5">
                            <div class="">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Selecione o Dispositivo: <select name="camera" id="cameraSelect" class="form-control">
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @if($exame->paciente->sexo == 0)
                                                                <span class="badge badge-light-primary"><i class="bi bi-person-fill text-primary"></i></span>
                                                            @else
                                                                <span class="badge badge-light-danger"><i class="bi bi-person-fill text-danger"></i></span>
                                                            @endif
                                                            Paciente: <b>{{ $exame->paciente->nome }}</b> ({{ $exame->paciente->cpf }})<br>
                                                            Data Nascimento: <b>{{ \Carbon\Carbon::parse($exame->paciente->dtnascimento)->format('d/m/Y')}}
                                                                ({{ Carbon\Carbon::createFromFormat('Y-m-d',
                                                                $exame->paciente->dtnascimento)->diffInYears(Carbon\Carbon::now()) }} anos)</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Procedimento: <b>{{ $exame->nome }}</b> <br>
                                                            Data: <b>{{ \Carbon\Carbon::parse($exame->data)->format('d/m/Y \à\\s H:i')}}h</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <button type="button" id="captureImg" onclick="captureImage()" class="btn btn-sm btn-primary me-2"> <i class="fa fas-camera"></i> Capturar</button>
                                            <a href="" class="btn btn-success me-2"><i class="fe fe-save"></i> Finalizar Captura</a>
                                            <a href="" class="btn btn-danger me-2"><i class="fe fe-x-circle"></i> Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css_plugins')
<style>
    video {
        width: 100%;
        max-height: 100%;
    }
    .over-delete-cap {
        position: absolute;
        top: 0;
        left: 0;
    }
    .btn-sml { height: 3vh; width: 2vh; padding-left:0px; padding-right:0px; padding-top:2px; padding-bottom: 0px; } /* change the value according to your need. */
</style>
@endpush
@push('js_plugins')
<script type="text/javascript" src="/assets/js/custom/webcam.js"></script>
@endpush

@push('js_custom')
<script>
    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
    const webcam = new Webcam(webcamElement, 'environment', canvasElement);

    if (!navigator.mediaDevices?.enumerateDevices) {
  console.log("enumerateDevices() not supported.");
} else {
  // List cameras and microphones.
  navigator.mediaDevices.enumerateDevices()
    .then((devices) => {
      devices.forEach((device) => {
        console.log(`${device.kind}: ${device.label} id = ${device.deviceId}`);
      });
    })
    .catch((err) => {
      console.error(`${err.name}: ${err.message}`);
    });
}

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    navigator.mediaDevices.enumerateDevices().then(function(devices) {
        devices.forEach(function(device) {
            if(device.kind == "videoinput")
            {
                let opt = document.createElement("option");
                opt.value = device.deviceId;
                opt.innerHTML = device.label;
                $('#cameraSelect').append(opt);
            }
            console.log(device.kind + ": " + device.label + " id = " + device.deviceId);
        });
    })
    .catch(function(err) {
    console.log(err.name + ": " + err.message);
    });
    webcam.start()
    .then(result =>{
    console.log("webcam started");
    getImagesList();
    })
    .catch(err => {
    console.log(err);
    });
    $('body').on('change', '#cameraSelect', function(e) {
        // console.log();
        webcam.stop()
        webcam.selectedDeviceId = this.options[this.selectedIndex].value;
        webcam.start()
        .then(result =>{
        console.log("webcam started");
        getImagesList();
        })
        .catch(err => {
        console.log(err);
        });
    });
    function captureImage()
    {
        console.log('capturar Imagem........');
        var picture = webcam.snap();
    }
    function getImagesList()
    {

    }
    $('body').on('click', '#btn-delete-img', function(e) {
        e.preventDefault();
        var href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            method: 'GET',
            success: function(result) {
                getImagesList();
            }
        });
    });
</script>
    
@endpush