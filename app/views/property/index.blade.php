@extends('layout')

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
							<img src="http://www.apartmentwiz.com/fort_worth_apartments/images/keller_apartments/1038_living_keller_apartments_3.jpg">
						</div>
						<div class="large-9 medium-9 small-12 columns">
							<strong>
								<?php echo $property->title, '. ' ?>
								<span class="label warning" style="float:right;">
									<?php echo $property->currency, ' ', $property->price ?>
								</span>
							</strong>
							<h5 class="subheader">
								<small>
									<?php echo $property->getOperationType()->name, ' | ',
														 $property->getPropertyType()->name, ' | ',
														 $property->getEnvironment()->name, ' | ',
														 $property->getNeighborhood()->name, ' | ',
														 $property->size, ' m2 | ',
														 $property->age, ' años' ?>
								</small>
							</h5>
							<hr>
							<?php echo $property->description, '.'; ?>
						</div>
					</div>
					</div>
				</div>
			</div>
		@endforeach
</div>
@stop
