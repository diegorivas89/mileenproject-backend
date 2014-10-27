@extends('layout')

@section('content')
<?php foreach ($errors as $error) var_dump($error) ?>
<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2><i class="fa fa-user"></i> Mi Perfil</h2>
		</div>
	</div>
	<form action="{{URL::action('profile.update')}}" method="post">
		<div class='panel'>
	        <div class='row'>
	            <div class='small-12 medium-6 columns end {{($errors->has('name')) ? 'error': ''}}'>
	                <span>Nombre</span>
	                <input type='text' name='name' value='{{Input::old('name', $user->name)}}'>
	                @if ($errors->has('name'))
	                	<small class="error">  {{ $errors->first('name') }} </small> 
	                @endif
	            </div>
	            <div class='small-12 medium-6 columns end {{($errors->has('telephone')) ? 'error': ''}}'>
	                <span>Teléfono</span>
	                <input type='text' name='telephone' value='{{Input::old('telephone', $user->telephone)}}'>
	                @if ($errors->has('telephone'))
	                	<small class="error">{{ $errors->first('telephone')}}</small> 
	                @endif
	            </div>
	        </div>
	        <div class='row'>
	            <div class='small-12 medium-6 columns end  {{($errors->has('email')) ? 'error': ''}}'>
	                <span>Email</span>
	                <input type='email' name='email' value='{{Input::old('email', $user->email)}}' disabled>
	                @if ($errors->has('email'))
	                	<small class="error">  {{ $errors->first('email') }} </small> 
	                @endif
	            </div>
	            <div class='small-12 medium-6 columns end {{($errors->has('password')) ? 'error': ''}}'>
	                <span>Contraseña</span>
	                <input type='password' name='password' value='xxxxxxxx' disabled>
	                @if ($errors->has('password'))
	                	<small class="error">{{ $errors->first('password')}}</small> 
	                @endif
	            </div>
	        </div>
	        {{--
	        <div class="row">
	        	<div class="columns small-12">
	        		<small>Por razones de seguridad debes ingresar tu contraseña cada vez que desees editar tus datos personales</small>
	        	</div>
	        </div>
	        --}}
	    </div>
	    <div class="row">
	    	<div class="columns small-12">
	    		<input type="submit" value="Guardar" class="button" id="submit-property">
				<a href="{{URL::action('profile.show')}}" class="button secondary">Cancelar</a>
	    	</div>
	    </div>
	</form>
</div>
@stop
