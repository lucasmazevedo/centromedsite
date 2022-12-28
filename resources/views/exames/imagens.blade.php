@foreach($exame->imagens as $imagem)
<div class="col-md-4">
    <div class="overlay">
        <!--begin::Image-->
        <div class="overlay-wrapper">
            <img src="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}" class="rounded w-100" alt="">
        </div>
        <!--end::Image-->
        <!--begin::Link-->
        <div class="overlay-layer bg-dark bg-opacity-10 rounded">
            <button id="btn-delete-img" data-attr="{{ route('exames.deleteImagem', $imagem->id) }}" class="btn btn-sm btn-danger btn-shadow"><i class="bi bi-trash-fill"></i></a>
        </div>
        <!--end::Link-->
    </div>
</div>
@endforeach
