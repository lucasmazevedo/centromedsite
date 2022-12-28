<!DOCTYPE html>
<html lang="pt-br">
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
.conteudo {
   width: 100%;
   color: black;
}

.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
  padding-top:5px;
}

.conteudo .assinatura {

    margin-bottom: 0px;
}
</style>
</head>
<body>
    <div class="conteudo">
        @php
            $count = 0;
        @endphp
        @foreach($data->imagens as $imagem)
        <div class="row">
            <div class="column"><img src="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}" width="432px" height="324px" alt=""></div>
            @if(++$count%2 == 0)
            {{-- <div class="column"><img src="data:image/png;base64,{{ chunk_split(base64_encode($imagem->image_blob)) }}" width="450px" alt=""></div> --}}
        </div>
        @endif
        @endforeach
    </div>
</body>
</html>
