$(document).ready(function(){

	if($('.creditly-wrapper .expiration-month-and-year').size() == 0) {
		return
	}

	creditly = Creditly.initialize(
		'.creditly-wrapper .expiration-month-and-year',
		'.creditly-wrapper .credit-card-number',
		'.creditly-wrapper .security-code',
		'.creditly-wrapper .card-type');

	var publicationType = getPublicationTypeBySelectedOptionValue($('#publication_type :selected').val());

	if(publicationType && publicationType.value == freePublication) {
		$('.creditly-wrapper').css('display', 'none')
		$('.expiration-month-and-year').attr('required', false)
		$('.credit-card-number').attr('required', false)
		$('.security-code').attr('required', false)
		$('.billing-address-name').attr('required', false)
	}

	$("#property-form").submit(function(e) {
		var publicationType = getPublicationTypeBySelectedOptionValue($('#publication_type :selected').val());
		if(publicationType && publicationType.value != freePublication) {
		  var output = creditly.validate();
		  if (!output) {
			e.preventDefault();
		  }
		}
	});

	$("body").on("creditly_client_validation_error", function(e, data) {
	  alert(data["messages"].join(", "));
	});

	function getPublicationTypeBySelectedOptionValue(selectedOptionValue){
		var publicationType = null;
		$.each(publicationTypes,function (index,value){
			if(value.id == selectedOptionValue){
				publicationType = value
			}
		})
		return publicationType;
	}

	$('#publication_type').change(function(e) {
		var publicationType = getPublicationTypeBySelectedOptionValue(this.options[e.target.selectedIndex].value);
		if(publicationType && publicationType.value == freePublication) {
			$('.creditly-wrapper').css('display', 'none')
			$('.expiration-month-and-year').attr('required', false)
			$('.credit-card-number').attr('required', false)
			$('.security-code').attr('required', false)
			$('.billing-address-name').attr('required', false)
		} else {
			$('.creditly-wrapper').css('display', 'block')
			$('.expiration-month-and-year').attr('required', true)
			$('.credit-card-number').attr('required', true)
			$('.security-code').attr('required', true)
			$('.billing-address-name').attr('required', true)
		}
	})

})
