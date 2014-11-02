@extends('layout')
@section('content')

<div class="large-9 columns">
	<div class="row">
		<div class="large-12 columns">
			<h2><i class="fa fa-newspaper-o"></i> Republicar esta propiedad</h2>
			<p>Dado que esta publicación es premium, para publicar esta propiedad debe completar sus datos de tarjeta de crédito.</p>
		</div>
	</div>
	<form id='property-form' action="{{URL::action('properties.savePayrepublish',[$propertyId]) }}" method="post" enctype="multipart/form-data">
		<section class="creditly-wrapper gray-theme">
		  <h3>Tarjeta de crédito</h3>
		  <i>
		    <div class="card-type" style="text-align:right;margin-top:10px;margin-right:10px;min-height:20px;margin-bottom:-15px"></div>
		  </i>
		  <div class="credit-card-wrapper">
		    <div class="first-row form-group">
		      <div class="col-sm-8 controls">
		        <label class="control-label">Número de tarjeta</label>
		        <input class="number credit-card-number form-control"
		          type="text" name="credit_card_number" required
		          inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"
		          placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
		      </div>
		      <div class="col-sm-4 controls">
		        <label class="control-label">CVC</label>
		        <input class="security-code form-control"·
		          inputmode="numeric" required
		          type="text" name="security_code"
		          placeholder="&#149;&#149;&#149;">
		      </div>
		    </div>
		    <div class="second-row form-group">
		      <div class="col-sm-8 controls">
		        <label class="control-label">Dueño de la tarjeta</label>
		        <input class="billing-address-name form-control"
		          type="text" name="card_owner" required
		          placeholder="John Smith">
		      </div>
		      <div class="col-sm-4 controls">
		        <label class="control-label">Vencimiento</label>
		        <input class="expiration-month-and-year form-control"
		          type="text" name="expiration_date" required
		          maxlength="10"
		          pattern=".{9}"
		          placeholder="MM / YYYY">
		      </div>
		    </div>
		  </div>
		</section>
		<div class="row">
			<div class="large-12 columns">
				<input type="submit" value="Guardar" class="button" id='submit-property'/>
				
			</div>
		</div>
	</form>
</div>
@stop
