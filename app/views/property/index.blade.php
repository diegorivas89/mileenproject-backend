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
						<img src="{{$property->getMainImageUrl('/assets/img/nophoto.jpg')}}">
					</div>
					<div class="large-9 medium-9 small-12 columns">
						<strong>
							{{$property->title}}
							<span class="label warning" style="float:right;">
								{{$property->currency}} {{$property->price}}
							</span>
						</strong>
						<h5 class="subheader">
							<small>
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
