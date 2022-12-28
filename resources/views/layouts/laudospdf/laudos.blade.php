<!DOCTYPE html>
<html lang="pt-br">
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
.conteudo {
   width: 100%;
   color: black;
   padding-top: 20px;
}

.conteudo .assinatura {
    text-align: center;
    margin-top: 50px;
    margin-bottom: 0px;
}
</style>
</head>
<body>
    <div class="conteudo">
        {!! $data->laudo->conteudo !!}
        <div class="assinatura">
            <img src="{{ asset('/storage/' . $data->laudo->user->assinatura) }}" alt="" height="80px">
            {!! $data->laudo->user->assinaturaRodape !!}
        </div>
    </div>
</body>
</html>
