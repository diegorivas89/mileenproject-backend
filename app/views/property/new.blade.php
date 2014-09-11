	@extends('layout')

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
				<div class="large-12 columns">
					<label>Tipo de Publicación
						<select name="">
							<option value="husker">Free</option>
							<option value="starbuck">Premium</option>
							<option value="hotdog">...</option>
						</select>
					</label>

				</div>

			</div>
			<div class="row">
				<div class="large-12 columns  @if ($errors->has('tipodeop')) error @endif">
					<label>Tipo de Operación
						<select name="">
							<option value="husker">Venta</option>
							<option value="starbuck">Alquiler</option>
							<option value="hotdog">Alquiler Temporal</option>
						</select>
						@if ($errors->has('tipodeop')) <small class="error"> {{ $errors->first('tipodeop') }} </small> @endif
					</label>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns  @if ($errors->has('property_type_id')) error @endif">

					<label>Tipo de Propiedad
						<select name="property_type_id" class="">
							<option value="husker">Departamento</option>
							<option value="starbuck">Casa</option>
							<option value="hotdog">Oficina</option>
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
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
					</div>
					<div class="row">
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
					</div>
					<div class="row">
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
					</div>
					<div class="row">
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
						<div class="large-3 columns">
							<input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-4 columns">
					<label>Barrio
						<select>
							<option value="husker">Almagro</option>
							<option value="starbuck">Palermo</option>
							<option value="hotdog">Balvanera</option>
						</select>
					</label>
				</div>
				<div class="large-8 columns">
					<label>Dirección
						<input type="text"   placeholder="" id="formatedAddress" name="address"/>
						<input type="hidden" id="latitude" value="" name="latitude"/>
						<input type="hidden" id="longitude" value=""name="longitude"/>
					</label>
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
					<div class="row collapse">
						<label>Tamaño</label>
						<div class="small-9 columns">
							<input type="text" placeholder="" />
						</div>
						<div class="small-3 columns">
							<span class="postfix">m<sup>2</sup></span>
						</div>
					</div>
				</div>
				<div class="large-4 columns">
					<div class="row collapse">
						<label>Ambientes</label>
						<div class="small-12 columns  @if ($errors->has('environment_id')) error @endif">
							<select name="environment_id" id="">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
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
					<div class="row collapse">
						<label>Moneda</label>
						<div class="small-12 columns  @if ($errors->has('currency')) error @endif">
							<select name="currency" id="">
								<option value="1">$</option>
								<option value="2">U$S</option>
							</select>
							@if ($errors->has('currency'))<small class="error">  {{ $errors->first('currency') }} </small> @endif
						</div>
					</div>
				</div>
				<div class="large-4 columns">
					<div class="row collapse">
						<label>Precio</label>
						<div class="small-12 columns  @if ($errors->has('price')) error @endif">
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
					<input type="submit" value="Guardar" class="button"/>
					<a href="" class="button secondary">Cancelar</a>
				</div>
			</div>
		</form>
	</div>


	@stop