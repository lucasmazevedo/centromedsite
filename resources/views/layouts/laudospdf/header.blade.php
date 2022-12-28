<!DOCTYPE html>
<html lang="pt-br">
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <table style="width: 100%; margin-left: auto; align: center; margin-right: auto;" border="0" cellspacing="1" cellpadding="0">
        <tbody>
            <tr>
                <td style="width:100px;" align="left"><img src="{{ asset($data->empresa->logo) }}" width="150px"></td>
                <td>
                    <table
                        style="height: 80px; width: 100%; padding-left: 10px; border-style: hidden; margin-left: auto; margin-right: auto;"
                        border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="height: 18px; width: 98.5796%;" colspan="2">Nome: <strong>{{ $data->paciente->nome }}</strong></td>
                            </tr>
                            <tr style="margin-top: 0px;">
                                <td style="height: 18px; width: 63.7784%;">Idade: <strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->age }}</strong> |
                                    Sexo:
                                    @if($data->paciente->sexo == 0)
                                        <strong>Masculino</strong>
                                    @else
                                        <strong>Feminino</strong>
                                    @endif
                                </td>
                                <td style="height: 18px; width: 34.8012%;">C&oacute;digo: <strong>{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="height: 18px; width: 63.7784%;">Data Nascimento: <strong>{{ \Carbon\Carbon::parse($data->paciente->dtnascimento)->format('d/m/Y') }}</strong></td>
                                <td style="height: 18px; width: 34.8012%;">Data do Exame: <strong>{{ \Carbon\Carbon::parse($data->data)->format('d/m/Y') }}</strong></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="height: 18px; width: 63.7784%;">M&eacute;dico Realizante:
                                    <strong>Dr. {{ $data->laudo->user->name }}</strong></td>
                                <td style="width: 34.8012%; height: 18px;">Data do Laudo: <strong>{{ \Carbon\Carbon::parse($data->laudo->data)->format('d/m/Y') }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
<hr>
</body>
</html>
