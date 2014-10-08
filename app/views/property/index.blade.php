@extends('layout')

@section('property-count')
<div class="panel callout radius">
	@if ($activeProperties->count() == 1)
		<h6>{{$activeProperties->count()}} Publicacion activa</h6>
	@else
		<h6>{{$activeProperties->count()}} Publicaciones activas</h6>
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
	@if (Session::has('message'))
	<div class="row">
		<div class="large-12 columns">
			<div data-alert class="alert-box info radius">
			  {{Session::get('message')}}
			  <a href="#" class="close">&times;</a>
			</div>
		</div>
	</div>
@endif
	@foreach($properties as $property)
		<div class="row">
			<div class="large-12 columns">
				<div class="panel">
				<div class="row">
					<div class="large-3 medium-3 small-12 columns">
						<a href="{{URL::action('properties.show', $property->id)}}">
							<img src="{{$property->getMainImageUrl('/assets/img/nophoto.jpg')}}">
						</a>
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
						  	@if($property->state == Property::active)
									<form class='property-form' action="{{URL::action('properties.pause', $property->id)}}" method='post'>
										<button>
							  			<i class='fa fa-pause'></i>
											{{Lang::get('strings.pause')}}
										</button>
									</form>
								@else
									@if($property->state == Property::paused)
										<form class='property-form' action="{{URL::action('properties.reactivate', $property->id)}}" method='post'>
											<button>
								  			<i class='fa fa-play'></i>
												{{Lang::get('strings.reactivate')}}
											</button>
										</form>
									@endif
								@endif
						  </li>
							<li>
								<a href="#">
									<i class='fa fa-pencil'></i>
									{{Lang::get('strings.edit')}}
								</a>
							</li>
							<li>
								<form class='property-form' action="{{URL::action('properties.delete', $property->id)}}" method='post'>
									<button id='delete-property'>
						  			<i class='fa fa-times'></i>
										{{Lang::get('strings.delete')}}
									</button>
								</form>
							</li>
						</ul>
					</div>
					<div class="large-9 medium-9 small-12 columns">
						<strong>
							<a href="{{URL::action('properties.show', $property->id)}}">{{$property->title}}</a>
							@if($property->state == Property::paused)
								<small>Pausada</small>
							@endif
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
