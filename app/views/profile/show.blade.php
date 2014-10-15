@extends('layout')

@section('content')
<script>
	$(document).ready(function(){
		$("button#delete-account").click(function(event){
			if (!confirm("Esta seguro que desea eliminar la cuenta?")){
				event.preventDefault();
			}
		});
	});
</script>
<?php foreach ($errors as $error) var_dump($error) ?>
<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2>
				<i class="fa fa-user"></i> Mi Perfil
				<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button  radius back " style="float:right;">
					<i class="fa fa-cogs"></i>
					{{Lang::get('strings.actions')}}
				</button>
				<br>
				<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
					<li>
						<a href="{{URL::action('profile.edit')}}">
							<i class='fa fa-pencil'></i>
							{{Lang::get('strings.edit')}}
						</a>
					</li>
					<li>
						<form class='property-form' action="{{URL::action('profile.delete')}}" method="post">
							<button type="submit" id="delete-account"><i class='fa fa-trash-o'></i> Borrar cuenta</button>
						</form>
					</li>
				</ul>
			</h2>
		</div>
	</div>
	<div class='panel'>
        <div class='row'>
            <div class='small-12 medium-6 columns end'>
                <span>Nombre</span>
                <input type='text' name='name' value='{{Input::old('name', $user->name)}}' disabled>
            </div>
            <div class='small-12 medium-6 columns end'>
                <span>Email</span>
                <input type='email' name='email' value='{{Input::old('email', $user->email)}}' disabled>
            </div>
        </div>
        <div class='row'>
            <div class='small-12 medium-6 columns end'>
                <span>Teléfono</span>
                <input type='text' name='telephone' value='{{Input::old('telephone', $user->telephone)}}' disabled>
            </div>
            <div class='small-12 medium-6 columns end'>
                <span>Contraseña</span>
                <input type='password' name='password' value='xxxxxxxxxx' disabled>
            </div>
        </div>
    </div>
</div>
@stop
