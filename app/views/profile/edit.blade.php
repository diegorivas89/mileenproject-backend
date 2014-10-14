@extends('layout')

@section('content')
<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2><i class="fa fa-user"></i> Mi Perfil</h2>
		</div>
	</div>
    <div class='panel'>
        <div class='row'>
            <div class='small-12 medium-6 columns end'>
                <span>Nombre</span>
                <input type='text' value='{{$user->name}}' disabled>
            </div>
            <div class='small-12 medium-6 columns end'>
                <span>Email</span>
                <span><a href=""><small>(Cambiar email)</small></a></span>
                <input type='email' value='{{$user->email}}' disabled>
            </div>
        </div>
        <div class='row'>
            <div class='small-12 medium-6 columns end'>
                <span>Contraseña</span>
                <span><a href=""><small>(Cambiar contraseña)</small></a></span>
                <input type='password' value='xxxxxxxxxx' disabled>
            </div>
            <div class='small-12 medium-6 columns end'>
                <span>Teléfono</span>
                <span><a href=""><small>(Cambiar teléfono)</small></a></span>
                <input type='text' value='{{$user->telephone}}' disabled>
            </div>
        </div>
    </div>
</div>
@stop
