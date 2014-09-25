@extends('layout')

@section('property-count')
<div class="panel callout radius">
	@if ($properties->count() == 1)
		<h6>{{$properties->count()}} Publicacion activa</h6>
	@else
		<h6>{{$properties->count()}} Publicaciones activas</h6>
	@endif
</div>
@endsection

@section('content')
<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2><i class="fa fa-newspaper-o"></i> Mis Publicaciones</h2>
		</div>
	</div>
	@foreach($properties as $property)
		<div class="row">
			<div class="large-12 columns">
				<div class="panel">
				<div class="row">
					<div class="large-3 medium-3 small-12 columns">
						<a href="{{URL::action('properties.show', $property->id)}}">
							<img src="{{$property->getMainImageUrl('/assets/img/nophoto.jpg')}}">
						</a>
						<!--
						<a data-dropdown="drop{{$property->id}}" aria-controls="drop{{$property->id}}" aria-expanded="false" class="button expand radius back long-height">
							<i class="fa fa-cogs"></i>
							{{Lang::get('strings.actions')}}
						</a>
						<ul id="drop{{$property->id}}" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
						  <li>
						  	<a href="{{URL::action('properties.show', $property->id)}}" >
						  		<i class='fa fa-arrow-right'></i>
						  		{{Lang::get('strings.details')}}
						  	</a>
						  </li>
						  <li>
						  	<a href="#">
						  		<i class='fa fa-pencil'></i>
						  		{{Lang::get('strings.edit')}}
						  	</a>
						  </li>
						</ul>
						-->
					</div>
					<div class="large-9 medium-9 small-12 columns">
						<strong>
							<a href="{{URL::action('properties.show', $property->id)}}">{{$property->title}}</a>
							<span class="label warning" style="float:right;">
								{{$property->currency}} {{$property->price}}
							</span>
						</strong>
						<h5 class="subheader">
							<small>
								{{$property->getPublicationType()->name}} |
								{{$property->getOperationType()->name}} |
								{{$property->getPropertyType()->name}}  |
								{{$property->getEnvironment()->name}} |
								{{$property->getNeighborhood()->name}} |
								{{$property->size}} m2 |
								{{$property->age}} años
							</small>
						</h5>
						<hr>
						{{$property->description}}
					</div>
				</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
@stop
