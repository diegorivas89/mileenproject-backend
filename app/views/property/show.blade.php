@extends('layout')
@section('content')
<style>
	.row div.row{margin-bottom:12px;}
	ul.features li{font-size:10pt;}
	ul.features li .field{font-weight:bold;}
</style>
<div class="large-9 columns">
	<div class='panel'>
		<div class="row">
			<div class="large-12 columns">
				<h2 style="background: #f2f2f2;margin-top: 0px;">
					<i class="fa fa-home"></i> {{$property->title}}
					<!--
					<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button  radius back " style="float:right;">
						<i class="fa fa-cogs"></i>
						{{Lang::get('strings.actions')}}
					</button>
					<br>
					<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
						<li>
							<a href="#">
								<i class='fa fa-pencil'></i>
								{{Lang::get('strings.edit')}}
							</a>
						</li>
					</ul>-->
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="large-6 medium-6 columns">
				<ul class="features">
					<li><span class="field">Tipo de Operación:</span> {{$property->getOperationType()->name}}</li>
					<li><span class="field">Tipo de Propiedad:</span> {{$property->getPropertyType()->name}}</li>
					<li><span class="field">Tipo de Publicación:</span> {{$property->getPublicationType()->name}}</li>
					<li><span class="field">Ambientes:</span> {{$property->getEnvironment()->name}}</li>
					<li><span class="field">Barrio:</span> {{$property->getNeighborhood()->name}}</li>
				</ul>
			</div>
			<div class="large-6 medium-6 columns">
				<ul class="features">
					<li><span class="field">Superficie:</span> {{$property->size}} m2</li>
					<li><span class="field">Superficie cubierta:</span> {{$property->covered_size}} m2</li>
					<li><span class="field">Antigüedad:</span> {{$property->age}} años</li>
					<li><span class="field">Precio:</span> {{$property->currency}}{{$property->price}}</li>
					<li><span class="field">Expensas:</span> {{$property->currency}} {{$property->expenses}}</li>
				</ul>
			</div>
		</div>
		
			<div class="content active" id="panel1">
				<div class="row">
					<div class="large-12 columns">
						<ul class="example-orbit" data-orbit>
							@foreach($images as $image)
								<li class="">
									<img src="{{$image->getUrl()}}" alt="slide 2" class='parent-width carousel-height'/>
								</li>
							@endforeach
							@if (!empty($property->video_url))
								<li>
									<div class="flex-video">
										<iframe width="300" src="{{$video['embed_url']}}" frameborder="0" allowfullscreen></iframe>
									</div>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		
		<div class="row">
			<div class="columns large-12">
				<h3>{{Lang::get('strings.description')}}</h3>
				@if (strlen(trim($property->description)) > 0)
					{{nl2br($property->description)}}
				@else
					<h4><small><i>Esta publicación no posee descripción.</i></small></h4>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="columns large-12">
				<h4>{{Lang::get('strings.amenities')}}</h4>
				<div class="row">
					@if (count($amenities) > 0)
						@foreach($amenities as $amenity)
							<div class="columns small-12 medium-6 large-4 end">
								<i class="fa fa-check"></i>
								<span> {{$amenity}} </span>
							</div>
						@endforeach
					@else
						<div class="columns large-12">
							<h4><small><i>Esta publicación no posee amenities.</i></small></h4>
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="columns large-12">
				<h4>Ubicación</h4>
				<img style="width:100%" src="http://maps.googleapis.com/maps/api/staticmap?center={{$property->latitude}},{{$property->longitude}}&zoom=15&size=1200x300&maptype=roadmap&markers=color:red%7C{{$property->latitude}},{{$property->longitude}}&sensor=false" alt="">
			</div>
		</div>
	</div>
</div>
@stop
