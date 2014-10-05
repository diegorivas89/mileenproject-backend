<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<style>
		body{font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;}
		table tbody tr td.field{color:gray;text-align: right;}
		</style>
	</head>
	<body>
		<h2>Hola {{$user->name}}, tienes un nuevo mensaje!</h2>
		<div>
			<h4>Mensaje enviado por {{$name}} &lt;{{$email}}&gt;</h4>
			<table>
				<tbody>
					<tr>
						<td style="color:gray;text-align: right;">Publicación:</td>
						<td>{{$property->id}} - {{$property->title}}</td>
					</tr>
					<tr>
						<td style="color:gray;text-align: right;">Asunto:</td>
						<td>{{$subject}}</td>
					</tr>
					<tr>
						<td style="color:gray;text-align: right;">Mensaje:</td>
						<td>{{$_message}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>