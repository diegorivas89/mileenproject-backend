@extends('layout')

@section('scripts')
<script>
	$(document).ready(function(){
		$('select#publication_type').change(function(){
				var imagesPerPublication = {{json_encode($publicationTypes->lists("images", "id"))}}
				var index = $(this).val();
				addImages(imagesPerPublication[index]);
		});

		var imagesPerPublication = {{json_encode($publicationTypes->lists("images", "id"))}}
		var index = $('select#publication_type').val();
		addImages(imagesPerPublication[index]);

		function addImages(limit){
			$("ol#img-container").empty();
			for (i = 0; i < limit; i++){
				$("ol#img-container").append('<li><input type="file" name="images[' + i + ']"/></li>');
			}
		}
	});
</script>
@endsection

@section('content')
<script type="text/javascript">
var map;
var geocoder;
var centerChangedLast;
var reverseGeocodedLast;
var currentReverseGeocodeResponse;

function initialize() {
	var latlng = new google.maps.LatLng(-34.608283394417995,-58.372238874435425);
	var myOptions = {
		zoom: 12,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	geocoder = new google.maps.Geocoder();
	setupEvents();
	centerChanged();
}

function setupEvents() {
	reverseGeocodedLast = new Date();
	centerChangedLast = new Date();

	setInterval(function() {
		if((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) {
			if(reverseGeocodedLast.getTime() < centerChangedLast.getTime())
				reverseGeocode();
		}
	}, 1000);

	google.maps.event.addListener(map, 'zoom_changed', function() {
		document.getElementById("zoom_level").innerHTML = map.getZoom();
	});

	google.maps.event.addListener(map, 'center_changed', centerChanged);

	google.maps.event.addDomListener(document.getElementById('crosshair'),'dblclick', function() {
		map.setZoom(map.getZoom() + 1);
	});

}

function getCenterLatLngText() {
	return '(' + map.getCenter().lat() +', '+ map.getCenter().lng() +')';
}

function centerChanged() {
	centerChangedLast = new Date();
	var latlng = getCenterLatLngText();
	var lat = map.getCenter().lat();
	var lng = map.getCenter().lng();

	document.getElementById('latitude').value = lat;
	document.getElementById('longitude').value = lng;

	document.getElementById('formatedAddress').value = '';
	currentReverseGeocodeResponse = null;
}

function reverseGeocode() {
	reverseGeocodedLast = new Date();
	geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult);
}

function reverseGeocodeResult(results, status) {
	currentReverseGeocodeResponse = results;
	if(status == 'OK') {
		if(results.length == 0) {
			document.getElementById('formatedAddress').value = 'None';
		} else {
			document.getElementById('formatedAddress').value = results[0].formatted_address;
		}
	} else {
		document.getElementById('formatedAddress').value = 'Error';
	}
}

function geocode() {
	var address = document.getElementById("address").value;
	geocoder.geocode({
		'address': address,
		'partialmatch': true}, geocodeResult);
}

function geocodeResult(results, status) {
	if (status == 'OK' && results.length > 0) {
		map.fitBounds(results[0].geometry.viewport);
	} else {
		alert("Geocode was not successful for the following reason: " + status);
	}
}

function addMarkerAtCenter() {
	var marker = new google.maps.Marker({
		position: map.getCenter(),
		map: map
	});

	var text = 'Lat/Lng: ' + getCenterLatLngText();
	if(currentReverseGeocodeResponse) {
		var addr = '';
		if(currentReverseGeocodeResponse.size == 0) {
			addr = 'None';
		} else {
			addr = currentReverseGeocodeResponse[0].formatted_address;
		}
		text = text + '<br>' + 'Dirección: <br>' + addr;
	}

	var infowindow = new google.maps.InfoWindow({ content: text });

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
}



</script>
<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2><i class="fa fa-newspaper-o"></i> Nueva Publicación</h2>
		</div>
	</div>
	<form  action="{{URL::action('properties.store') }}" method="post">
		<div class="row">
			<input type="hidden" name="user_id" value="2">
			<div class="large-12 columns  @if ($errors->has('publication_type_id')) error @endif">
				<label>Tipo de Publicación
					<select name="publication_type_id" id="publication_type">
						@foreach ($publicationTypes as $publicationType)
						    <option value='{{$publicationType->id}}'>{{$publicationType->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('publication_type_id')) <small class="error"> {{ $errors->first('publication_type_id') }} </small> @endif
				</label>

			</div>

		</div>
		<div class="row">
			<div class="large-12 columns  @if ($errors->has('tipodeop')) error @endif">
				<label>Tipo de Operación
					<select name="">
						@foreach ($operationTypes as $operationType)
						    <option value='{{$operationType->id}}'>{{$operationType->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('tipodeop')) <small class="error"> {{ $errors->first('tipodeop') }} </small> @endif
				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns  @if ($errors->has('property_type_id')) error @endif">

				<label>Tipo de Propiedad
					<select name="property_type_id" class="">
						@foreach ($propertyTypes as $propertyType)
						    <option value='{{$propertyType->id}}'>{{$propertyType->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('property_type_id')) <small class="error"> {{ $errors->first('property_type_id') }} </small> @endif

				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<h5>Propiedad</h5>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns @if ($errors->has('title')) error @endif">
				<label>Titulo
					<input name="title" type="text" placeholder="" class="form-control" />
					@if ($errors->has('title'))<small class="error">  {{ $errors->first('title') }} </small> @endif
				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns @if ($errors->has('description')) error @endif">
				<label>Descripción
					<textarea name="description" placeholder=""></textarea>
					@if ($errors->has('description'))<small class="error">  {{ $errors->first('description') }} </small> @endif
				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label>Amenities</label>
				<div class="row">
					@foreach ($amenitieTypes as $amenitieType)
					<div class="large-3 columns">
						<label for="amenitieType_{{$amenitieType->id}}"><input id="amenitieType_{{$amenitieType->id}}" name="amenitieType[]" value="{{$amenitieType->id}}" type="checkbox"> {{$amenitieType->name}}</label>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns @if ($errors->has('barrio')) error @endif">
				<label>Barrio
					<select>
						@foreach ($amenitieTypes as $neighborhood)
						    <option value='{{$neighborhood->id}}'>{{$neighborhood->name}}</option>
						@endforeach
					</select>
				</label>
				@if ($errors->has('barrio'))<small class="error">  {{ $errors->first('barrio') }} </small> @endif
			</div>
			<div class="large-8 columns  @if ($errors->has('address')) error @endif">
				<label>Dirección
					<input type="text"  readonly="readonly" placeholder="" id="formatedAddress" name="address"/>
					<input type="hidden" id="latitude" value="" name="latitude"/>
					<input type="hidden" id="longitude" value=""name="longitude"/>
				</label>
				@if ($errors->has('address'))<small class="error">  {{ $errors->first('address') }} </small> @endif
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<div id="map">
					<div id="map_canvas"></div>
					<div id="crosshair"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns">
				<div class="row collapse  @if ($errors->has('size')) error @endif">
					<label>Tamaño</label>
					<div class="small-9 columns">
						<input type="text" name="size" placeholder="" />
					</div>
					<div class="small-3 columns">
						<span class="postfix">m<sup>2</sup></span>
					</div>
					@if ($errors->has('size'))<small class="error">  {{ $errors->first('size') }} </small> @endif
				</div>
			</div>
			<div class="large-4 columns">
				<div class="row collapse  @if ($errors->has('environment_id')) error @endif">
					<label>Ambientes</label>
					<div class="small-12 columns">
						<select name="environment_id" id="">
						@foreach ($environments as $environment)
						    <option value='{{$environment->id}}'>{{$environment->name}}</option>
						@endforeach
						</select>
						@if ($errors->has('environment_id'))<small class="error">  {{ $errors->first('environment_id') }} </small> @endif
					</div>
				</div>
			</div>
			<div class="large-4 columns">
				<div class="row collapse  @if ($errors->has('age')) error @endif">
					<label>Antiguedad</label>
					<div class="small-9 columns ">
						<input type="text" name="age" placeholder="" />
						@if ($errors->has('age'))<small class="error">  {{ $errors->first('age') }} </small> @endif
					</div>
					<div class="small-3 columns">
						<span class="postfix">años</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns">
				<div class="row collapse  @if ($errors->has('currency')) error @endif">
					<label>Moneda</label>
					<div class="small-12 columns">
						<select name="currency" id="">
							<option value="1">$</option>
							<option value="2">U$S</option>
						</select>
						@if ($errors->has('currency'))<small class="error">  {{ $errors->first('currency') }} </small> @endif
					</div>
				</div>
			</div>
			<div class="large-4 columns">
				<div class="row collapse  @if ($errors->has('price')) error @endif">
					<label>Precio</label>
					<div class="small-12 columns">
						<input type="text" name="price" placeholder="" />
						@if ($errors->has('price'))<small class="error">  {{ $errors->first('price') }} </small> @endif
					</div>
				</div>
			</div>
			<div class="large-4 columns ">
				<div class="row collapse  @if ($errors->has('expenses')) error @endif">
					<label>Expensas</label>
					<div class="small-12 columns">
						<input type="text" name="expenses" placeholder="" />
						@if ($errors->has('expenses'))<small class="error">  {{ $errors->first('expenses') }} </small> @endif
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<h5>Imágenes</h5>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<ol id="img-container"></ol>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<input type="submit" value="Guardar" class="button"/>
				<a href="" class="button secondary">Cancelar</a>
			</div>
		</div>
	</form>
</div>
@stop