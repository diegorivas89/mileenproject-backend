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
						<td><a href="{{URL::action('properties.show', $property->id)}}">{{$property->id}} - {{$property->title}}</a></td>
					</tr>
					<tr>
						<td style="color:gray;text-align: right;">Telefono:</td>
						<td>{{$telephone}}</td>
					</tr>
					<tr>
						<td style="color:gray;text-align: right;">Horario de respuesta:</td>
						<td>{{$callAt}}</td>
					</tr>
					<tr>
						<td style="color:gray;text-align: right;">Mensaje:</td>
						<td>{{$_message}}</td>
					</tr>
				</tbody>
			</table>
			<br><br>
			<p>Responde este email para responderle a {{$name}}</p>
		</div>
	</body>
</html>