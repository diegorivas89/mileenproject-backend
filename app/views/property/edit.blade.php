@extends('layout')

@section('content')
<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2><i class="fa fa-home"></i> {{$property->title}}</h2>
		</div>
	</div>
	<form action="{{URL::action('properties.update', $property->id)}}" method="post">
		<input type="hidden", name="_method" value="PUT">
		<div class='panel'>
			<div class='row'>
	            <div class='small-12 medium-2 columns end {{($errors->has('currency')) ? 'error': ''}}'>
	                <span>Moneda</span>
	                <select name="currency" id="">
						<option value="$" {{ ($property->currency == '$') ? 'selected': '' }}>$</option>
						<option value="U$S" {{ ($property->currency == 'U$S') ? 'selected': '' }}>U$S</option>
					</select>
	                @if ($errors->has('currency'))
	                	<small class="error">  {{ $errors->first('currency') }} </small> 
	                @endif
	            </div>
	            <div class='small-12 medium-5 columns end {{($errors->has('price')) ? 'error': ''}}'>
	                <span>Precio</span>
	                <input type='text' name='price' value='{{Input::old('price', $property->price)}}' maxlength="7">
	                @if ($errors->has('price'))
	                	<small class="error">  {{ $errors->first('price') }} </small> 
	                @endif
	            </div>
	            <div class='small-12 medium-5 columns end {{($errors->has('expenses')) ? 'error': ''}}'>
	                <span>Expensas</span>
	                <input type='text' name='expenses' value='{{Input::old('expenses', $property->expenses)}}' maxlength="7">
	                @if ($errors->has('expenses'))
	                	<small class="error">  {{ $errors->first('expenses') }} </small> 
	                @endif
	            </div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="columns small-12">
	    		<input type="submit" value="Guardar" class="button" id="submit-property">
				<a href="{{URL::action('properties.show', $property->id)}}" class="button secondary">Cancelar</a>
	    	</div>
	    </div>
	</form>
</div>
@stop
