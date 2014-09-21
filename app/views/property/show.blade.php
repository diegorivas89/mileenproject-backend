@extends('layout')
@section('content')
<div class="large-9 columns">
	<div class='panel'>
		<div class="row">
			<div class="large-12 columns">
				<h2 style="background: #f2f2f2;margin-top: 0px;padding: 20px;">
					<i class="fa fa-home"></i> {{$property->title}}
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
					</ul>
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<h5>
					{{$property->getOperationType()->name}} |
					{{$property->getPropertyType()->name}}  |
					{{$property->getEnvironment()->name}} |
					{{$property->getNeighborhood()->name}} |
					{{$property->size}} m2 |
					{{$property->age}} años
				</h5>
			</div>
		</div>
		<div class="content active" id="panel1">
			<div class="row">
				<div class="large-12 columns">
					<ul class="example-orbit" data-orbit>
						@foreach($images as $image)
							<li class="">
								<img src="{{$image->getUrl()}}" alt="slide 2" class='parent-width'/>
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
				{{$property->description}}
			</div>
		</div>
		<div class="row">
			<div class="columns large-12">
				<h4>{{Lang::get('strings.amenities')}}</h4>
				<div class="row">
					@foreach($amenities as $amenity)
						<div class="columns small-4 large-4 end">
							<i class="fa fa-check"></i>
							<span> {{$amenity}} </span>
						</div>
					@endforeach
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
