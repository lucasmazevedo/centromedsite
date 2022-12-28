<!DOCTYPE html>
<html lang="pt-br">
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <table style="width: 100%;margin-right:auto; padding:2px; margin-top:5px;">
        <tr>
            <td style="width: 170px;">
                @if(!$data->empresa->logo == null)
                    <img src="{{ asset($data->empresa->logo) }}" width="150px" />
                @else
                    <img src="assets/media/avatar/300-1.jpg" width="150px" />
                @endif
            </td>
            <td style="font-size: 12pt;">
                <table style="width: 100%; margin-left: auto; margin-right: auto;" border="0">
                    <tbody>
                        <tr>
                            <td colspan="2">Nome: <strong>{{ $data->paciente->nome }}</strong></td>
                        </tr>
                        <tr>
                            <td>Idade: <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d',
                            $data->paciente->dtnascimento)->diffInYears(Carbon\Carbon::now()) }} anos </strong>|
                                Sexo:&nbsp;<strong>
                                    @if($data->paciente->sexo == 0)
                                    Masculino
                                    @else
                                    Feminino
                                    @endif</strong></td>
                            <td>Procedimento: <strong>{{ $data->nome }}</strong></td>
                        </tr>
                        <tr>
                            <td>Data Nascimento: <strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->format('d/m/Y')}}</strong></td>
                            <td>Data Captura: <strong>{{ \Carbon\Carbon::parse($data->data)->format('d/m/Y')}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
<hr>
</body>
</html>
