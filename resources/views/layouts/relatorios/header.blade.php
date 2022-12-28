<!DOCTYPE html>
<html lang="pt-br">
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<table style="width: 100%;">
	<tbody>
		<tr style="text-align: center;">
			<td colspan="3"><h1>Relatório</h1></td>
		</tr>
		
		<tr style="text-align: center; font-size: 16px;">
			<td>Data: {{ $dataRel }}</td>
            <td>Empresa: {{$empresa}} </td>
            <td>Usuário: {{ $user->name }}</td>
		</tr>
	</tbody>
</table>
<hr>
</body>
</html>
