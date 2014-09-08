	<!doctype html>
	<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
	<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
		<head>
			<meta charset="utf-8"/>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			<title>MiLEEM</title>
			<meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more."/>
			<meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
			<meta name="copyright" content="ZURB, inc. Copyright (c) 2014"/>
			<link rel="stylesheet" href="../assets/libs/foundation/css/foundation.css"/>
			<script src="../assets/libs/foundation/js/vendor/modernizr.js"></script>
			<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
		</head>
		<body>
			<div class="row">
				<div class="large-12 columns">

					<div class="row">
						<div class="large-12 columns">
							<nav class="top-bar" data-topbar>
								<ul class="title-area">
									<li class="name">
									<h1><a href="/">MiLEEN</a></h1>
									</li>
									<li class="toggle-topbar menu-icon">
										<a href="#"><span>menu</span></a>
									</li>
								</ul>
								<section class="top-bar-section">

									<ul class="right">
										<li class="divider"></li>
										<li class="has-dropdown">
											<a href="#"><i class="fa fa-user"></i> Alejandro Molinari</a>
											<ul class="dropdown">
												<li>
													<a href="#"><i class="fa fa-cog"></i> Mi Perfil</a>
												</li>
												<li class="divider"></li>
												<li>
													<a href="#"><i class="fa fa-sign-out"></i> Salir</a>
												</li>
											</ul>
										</li>
									</ul>
								</section>
							</nav>
						</div>
					</div>
					<div class="row">

						<div class="large-3 small-12 columns">
							<div class="panel">
								<ul class="side-nav">
									<li class="active"><a href="#"><i class="fa fa-newspaper-o"></i> Mis Publicaciones</a></li>
									<li><a href="form.html"><i class="fa fa-home"></i> Nueva Publicación</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="fa fa-cog"></i> Mi Perfil</a></li>
									<li><a href="#"><i class="fa fa-sign-out"></i> Salir</a></li>
								</ul>
							</div>
							<a href="#">
								<div class="panel callout radius">
									<h6>99 Publicaciones activas</h6>
								</div>
							</a>
						</div>
						@yield('content')
					</div>
					<footer class="row">
						<div class="large-12 columns">
							<hr>
							<div class="row">
								<div class="large-6 columns">
									<p>© MiLEEN 2014</p>
								</div>
							</div>
						</div>
					</footer>
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