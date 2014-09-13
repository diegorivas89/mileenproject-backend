@extends('layout')

@section('scripts')
<script>
	$(document).ready(function(){
		/**
		 * Cambio la cantidad de inputs para imagenes dependiendo del tipo de publicacion
		 */
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

		/**
		 * Muestro o escondo la carga de video dependiendo si acepta o no el tipo de publicacion
		 */
		$('select#publication_type').change(function(){
				var acceptVideo = {{json_encode($publicationTypes->lists("video", "id"))}}
				var index = $(this).val();
				if (acceptVideo[index] == "1"){
					$("div#video-container").show();
				}else{
					$("div#video-container").hide();
				}
		});

		var acceptVideo = {{json_encode($publicationTypes->lists("video", "id"))}}
		var index = $('select#publication_type').val();
		if (acceptVideo[index] == 1){
			$("div#video-container").show();
		}else{
			$("div#video-container").hide();
		}

		/**
		 * Video de youtube
		 */
		$("input#url-video").change(function(){
			var url = $(this).val();

			var myId = getId($(this).val());
			if (myId != 'error'){
				var myCode = '<div class="flex-vide"><iframe width="420" height="315" src="//www.youtube.com/embed/' 
					+ myId + '" frameborder="0" allowfullscreen></iframe></div>';

				$("div#youtube-video-container").html(myCode);
			}
		});

		function getId(url) {
			var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
			var match = url.match(regExp);

			if (match && match[2].length == 11) {
				return match[2];
			} else {
				return 'error';
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
	<form  action="{{URL::action('properties.store') }}" method="post" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="user_id" value="2">
			<div class="large-12 columns  @if ($errors->has('publication_type_id')) error @endif">
				<label>Tipo de Publicación
					<select name="publication_type_id" id="publication_type">
						@foreach ($publicationTypes as $publicationType)
						    <option value='{{$publicationType->id}}' {{($publicationType->id == Input::old('publication_type_id', '') ? 'selected' : '')}}>{{$publicationType->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('publication_type_id')) <small class="error"> {{ $errors->first('publication_type_id') }} </small> @endif
				</label>

			</div>

		</div>
		<div class="row">
			<div class="large-12 columns  @if ($errors->has('tipodeop')) error @endif">
				<label>Tipo de Operación
					<select name="operation_type_id">
						@foreach ($operationTypes as $operationType)
						    <option value='{{$operationType->id}}' {{($operationType->id == Input::old('operation_type_id', '') ? 'selected' : '')}}>{{$operationType->name}}</option>
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
						    <option value='{{$propertyType->id}}' {{($propertyType->id == Input::old('property_type_id', '') ? 'selected' : '')}}>{{$propertyType->name}}</option>
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
					<input name="title" type="text" maxlength="128" placeholder="" value="{{Input::old("title", "")}}" class="form-control" />
					@if ($errors->has('title'))<small class="error">  {{ $errors->first('title') }} </small> @endif
				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns @if ($errors->has('description')) error @endif">
				<label>Descripción
					<textarea name="description" placeholder="">{{Input::old("description", "")}}</textarea>
					@if ($errors->has('description'))<small class="error">  {{ $errors->first('description') }} </small> @endif
				</label>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label>Amenities</label>
				<div class="row">
					@foreach ($amenitieTypes as $amenitieType)
					<div class="medium-3 large-3 columns">
						<label for="amenitieType_{{$amenitieType->id}}"><input id="amenitieType_{{$amenitieType->id}}" name="amenitieType[{{$amenitieType->id}}]" value="1" type="checkbox" {{(Input::old('amenitieType.'.$amenitieType->id) ? 'checked': '')}}> {{$amenitieType->name}}</label>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-4 columns @if ($errors->has('barrio')) error @endif">
				<label>Barrio
					<select name="neighborhood_id">
						@foreach ($neighborhoods as $neighborhood)
						    <option value='{{$neighborhood->id}}' {{($neighborhood->id == Input::old('neighborhood_id', '') ? 'selected' : '')}}>{{$neighborhood->name}}</option>
						@endforeach
					</select>
				</label>
				@if ($errors->has('barrio'))<small class="error">  {{ $errors->first('barrio') }} </small> @endif
			</div>
			<div class="large-8 columns  @if ($errors->has('address')) error @endif">
				<label>Dirección
					<input type="text" readonly=true placeholder="" id="formatedAddress" name="address" value="{{Input::old("address", "")}}"/>
					<input type="hidden" id="latitude" value="" name="latitude"/>
					<input type="hidden" id="longitude" value="" name="longitude"/>
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
			<div class="large-3 columns">
				<div class="row collapse  @if ($errors->has('size')) error @endif">
					<label>Tamaño Total</label>
					<div class="small-9 columns">
						<input type="text" name="size" placeholder="" value="{{Input::old('size', '')}}"/>
					</div>
					<div class="small-3 columns">
						<span class="postfix">m<sup>2</sup></span>
					</div>
					@if ($errors->has('size'))<small class="error">  {{ $errors->first('size') }} </small> @endif
				</div>
			</div>
			<div class="large-3 columns">
				<div class="row collapse  @if ($errors->has('covered_size')) error @endif">
					<label>Tamaño Cubierto</label>
					<div class="small-9 columns">
						<input type="text" name="covered_size" placeholder="" value="{{Input::old('covered_size', '')}}"/>
					</div>
					<div class="small-3 columns">
						<span class="postfix">m<sup>2</sup></span>
					</div>
					@if ($errors->has('covered_size'))<small class="error">  {{ $errors->first('covered_size') }} </small> @endif
				</div>
			</div>
			
			<div class="large-3 columns">
				<div class="row collapse  @if ($errors->has('environment_id')) error @endif">
					<label>Ambientes</label>
					<div class="small-12 columns">
						<select name="environment_id" id="">
						@foreach ($environments as $environment)
						    <option value='{{$environment->id}}' {{($environment->id == Input::old('environment_id', '') ? 'selected' : '')}}>{{$environment->name}}</option>
						@endforeach
						</select>
						@if ($errors->has('environment_id'))<small class="error">  {{ $errors->first('environment_id') }} </small> @endif
					</div>
				</div>
			</div>
			<div class="large-3 columns">
				<div class="row collapse  @if ($errors->has('age')) error @endif">
					<label>Antiguedad</label>
					<div class="small-9 columns ">
						<input type="text" name="age" placeholder="" value="{{Input::old('age', '')}}"/>
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
							<option value="$">$</option>
							<option value="U$S" {{('U$S' == Input::old('currency', '') ? 'selected' : '')}}>U$S</option>
						</select>
						@if ($errors->has('currency'))<small class="error">  {{ $errors->first('currency') }} </small> @endif
					</div>
				</div>
			</div>
			<div class="large-4 columns">
				<div class="row collapse  @if ($errors->has('price')) error @endif">
					<label>Precio</label>
					<div class="small-12 columns">
						<input type="text" name="price" placeholder="" value="{{Input::old('price', '')}}"/>
						@if ($errors->has('price'))<small class="error">  {{ $errors->first('price') }} </small> @endif
					</div>
				</div>
			</div>
			<div class="large-4 columns ">
				<div class="row collapse  @if ($errors->has('expenses')) error @endif">
					<label>Expensas</label>
					<div class="small-12 columns">
						<input type="text" name="expenses" placeholder="" value="{{Input::old('expenses', '')}}"/>
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
		<div class="row hide" id="video-container">
			<div class="large-12 columns">
				<div class="row">
					<div class="large-12 columns">
						<h5>Video</h5>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="small-12 columns">
								<input type="text" name="video_url" value="{{Input::old('video_url', '')}}" placeholder="Pega aqui la url de tu video de youtube" id="url-video"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns" id="youtube-video-container"></div>
				</div>
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