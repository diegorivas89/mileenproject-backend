@extends('layout')
@section('content')
<div class="large-9 columns" style="background: #f2f2f2;">
	<div class="row">
		<div class="large-12 columns">
			<h2 style="background: #f2f2f2;margin-top: 0px;padding: 20px;">
				<i class="fa fa-home"></i> Palermo 3 Amb.
				<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button  radius back " style="float:right;">
					<i class="fa fa-cogs"></i>
				Acciones
				</button><br>
				<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
					<li><a href="#">This is a link</a></li>
					<li><a href="#">This is another</a></li>
					<li><a href="#">Yet another</a></li>
				</ul>
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<h5>Alquiler Temporal | Departamento | 2 Amb. | Palermo | 40 m2 | 30 años</h5>
		</div>
	</div>
	<div class="content active" id="panel1">
		<div class="row">
			<div class="large-12 columns">
				<ul class="example-orbit" data-orbit>
					<li class="active">
						<img src="http://www.myfurnishedapartment.ca/wp-content/uploads/background/1357717580.jpg" alt="slide 2" />
					</li>
					<li>
						<img src="http://www.apartmentwiz.com/fort_worth_apartments/images/keller_apartments/1815_exterior_1.jpg" alt="slide 3" />
					</li>
					<li>
						<div class="flex-video">
								<iframe width="300" src="//www.youtube.com/embed/4PkcfQtibmU" frameborder="0" allowfullscreen></iframe>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="columns large-12">
			<h3>Descripción</h3>
			Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum
			odio ornare sagittis
			Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum
			odio ornare sagittis
			Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum
			odio ornare sagittis
		</div>
	</div>
	<div class="row">
		<div class="columns large-12">
			<h4>Amenities</h4>
			<div class="row">
				<div class="columns large-3">
					<i class="fa fa-check"></i> Laundry
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Sauna
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Piscina
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Terraza
				</div>
			</div>
			<div class="row">
				<div class="columns large-3">
					<i class="fa fa-check"></i> Laundry
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Sauna
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Piscina
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Terraza
				</div>
			</div>
			<div class="row">
				<div class="columns large-3">
					<i class="fa fa-check"></i> Laundry
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Sauna
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Piscina
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Terraza
				</div>
			</div>
			<div class="row">
				<div class="columns large-3">
					<i class="fa fa-check"></i> Laundry
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Sauna
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Piscina
				</div>
				<div class="columns large-3">
					<i class="fa fa-check"></i> Terraza
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="columns large-12">
			<h4>Ubicación</h4>
			<img style="width:100%" src="http://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=1200x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Ccolor:red%7Clabel:C%7C40.718217,-73.998284&sensor=false" alt="">
		</div>
	</div>
</div>
@stop
