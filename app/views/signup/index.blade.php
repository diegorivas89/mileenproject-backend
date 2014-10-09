<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>MiLEEM - Ingresar</title>
	<link href='/assets/img/logo_mileen.ico' rel='shortcut icon' type='image/x-icon'>
	<meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more."/>
	<meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
	<meta name="copyright" content="ZURB, inc. Copyright (c) 2014"/>
	<link rel="stylesheet" href="../assets/libs/foundation/css/foundation.css"/>
	<script src="../assets/libs/foundation/js/vendor/modernizr.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
	<style type="text/css">
	div.row.footer{
		position: relative;
		margin-top: 60px;
	}
	div.row.footer > div{
		position:absolute;
		top:0;
		width: 100%;
		max-width: 62.5rem;
		color: white;
	}
	body{
		/*background: url('/assets/img/argentina.jpg'); */
		background: url('/assets/img/bairescity.jpg');
		background-size: cover;

		background-repeat: no-repeat;
		background-attachment: fixed;
		background-position-x: 50%;
		background-position-y: -75px;
	}
	</style>
</head>
<body style="">
	<div class="row">
		<div class="large-12 columns">
			<div class="row" style="margin-bottom: 30px;text-align: center;">
				<div class="large-3 small-12 columns">&nbsp;</div>
				<div class="large-6 small-12 columns"><img src="/assets/img/logo_mileen.png" alt=""></div>
				<div class="large-3 small-12 columns">&nbsp;</div>
			</div>
			<div class="row">
				<div class="large-3 small-12 columns">&nbsp;</div>
				<div class="large-6 small-12 columns">
					<form action="{{URL::route('signup.post')}}" method="post">
						<div class="panel radius" style="box-shadow: 7px 7px 8px 2px lightgray;">
							<div class="row">
								<div class="large-12 columns  @if ($errors->has('name')) error @endif">
									<label>* Nombre
										<input type="text" value="{{Input::old("name", "")}}" name="name" placeholder="" />
										@if ($errors->has('name')) <small class="error"> {{ $errors->first('name') }} </small> @endif
									</label>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns  @if ($errors->has('email')) error @endif">
									<label>* Email
										<input type="text" value="{{Input::old("email", "")}}" name="email" placeholder="" />
										@if ($errors->has('email')) <small class="error"> {{ $errors->first('email') }} </small> @endif
									</label>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns  @if ($errors->has('telephone')) error @endif">
									<label>Teléfono
										<input type="text" value="{{Input::old("telephone", "")}}" name="telephone" placeholder="" />
										@if ($errors->has('telephone')) <small class="error"> {{ $errors->first('telephone') }} </small> @endif
									</label>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns  @if ($errors->has('password')) error @endif">
									<label>* Contraseña
										<input type="password" value="{{Input::old("password", "")}}" name="password" placeholder="" />
										@if ($errors->has('password')) <small class="error"> {{ $errors->first('password') }} </small> @endif
									</label>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns  @if ($errors->has('password_confirmation')) error @endif">
									<label>Confirmar Contraseña
										<input type="password" value="{{Input::old("password_confirmation", "")}}" name="password_confirmation"  placeholder="" />
										@if ($errors->has('password_confirmation')) <small class="error"> {{ $errors->first('password_confirmation') }} </small> @endif
									</label>
								</div>
							</div>
							@if (Session::has('technical-problems'))
								<div class="row">
									<div class="large-12 columns">
										<div data-alert class="alert-box warning radius">
										  {{Session::get('technical-problems')}}
										</div>
									</div>
								</div>
							@endif
							<div class="row">
								<div class="large-12 columns">
									<h5><small>Los campos marcados con (*) son obligatorios</small></h5>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns text-right">
									<a href="{{URL::action('login.get')}}" class="button secondary">Cancelar</a>
									<input type="submit" value="Crear" class="button"/>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="large-3 small-12 columns">&nbsp;</div>
			</div>
		</div>

	</div>
	<div class="row footer">
		<div class="large-12">
			<div class="large-12 columns">
				<hr>
				<div class="row">
					<div class="large-6 columns">
						<p>© MiLEEM 2014</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
document.write('<script src=' +
	('__proto__' in {} ? '//cdnjs.cloudflare.com/ajax/libs/zepto/1.1.4/zepto.min.js' : 'https://code.jquery.com/jquery-2.1.1.min.js') +
	'><\/script>')
</script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="/assets/libs/foundation/js/foundation.min.js"></script>
<script>
$(document).foundation();
</script>
<script>
$(document).foundation();

var doc = document.documentElement;
doc.setAttribute('data-useragent', navigator.userAgent);
</script>
</body>
</html>