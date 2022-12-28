<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
}
td, th {
	padding: 3px;
	width: 30px;
	height: 25px;
}
th {
	background: #f0e6cc;
}
.even {
	background: #fbf8f0;
}
.odd {
	background: #fefcf9;
}
    </style>
</head>
<body>
<table style="width:100%; text-align: center; vertical-align: middle;">
	<tbody>
		<tr>
			<td>PACIENTE</td>
			<td>EXAME</td>
			<td>DATA DO EXAME</td>
			<td>SITUACAO</td>
			<td>LAUDO</td>
		</tr>
        @foreach ($data as $exame)
        <tr>
			<td>
                Nome: <strong>{{ $exame->paciente->nome }}</strong> <br>
                Nascimento: <strong>{{ \Carbon\Carbon::parse($exame->paciente->dtnascimento)->format('d/m/Y')  }}</strong>
            </td>
			<td>
                Exame: <strong>{{ $exame->nome }}</strong>
            </td>
			<td>
            <strong>{{ \Carbon\Carbon::parse($exame->data)->format('d/m/Y')  }}</strong>
            </td>
			<td>
            <strong>{!! $exame->situacao !!}</strong>
            </td>
            @if($exame->laudo)
			<td>
                
                Laudado por <strong>{{ $exame->laudo->first()->user->name }}</strong><br>
                em <strong>{{ \Carbon\Carbon::parse($exame->laudo->data)->format('d/m/Y'). "às" . \Carbon\Carbon::parse($exame->laudo->data)->format('h:i') }}</strong>

            </td>
            @else
            <td>---</td>
            @endif
		</tr>
        @endforeach
	</tbody>
</table>
<table align="right" style="margin-top: 10px; width: 20%;">
    <tbody>
		<!-- <tr>
			<td>Exames Pendentes:</td>
            <td>1</td>
		</tr>
        <tr>
            <td>Exames Capturados:</td>
            <td>1</td>
		</tr>
        <tr>
            <td>Exames Laudados:</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Exames Cancelados:</td>
            <td>1</td>
        </tr> -->
        <tr>
            <td>Total:</td>
            <td><strong>{{$data->count()}}</strong></td>
        </tr>
	</tbody>
</table>
</body>
</html>