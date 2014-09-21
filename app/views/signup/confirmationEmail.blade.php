<h1>Bienvenido, {{ $name }}!</h1>
Para activar tu cuenta haz click 
{{ HTML::link( $clickUrl , 'aquí')}}. <br /><br />
Si no puedes hacer click copia la siguiente url en un browser:
 <br /><br />
{{$clickUrl}}
