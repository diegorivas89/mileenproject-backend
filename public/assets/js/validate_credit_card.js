$(document).ready(function(){

	creditly = Creditly.initialize(
		'.creditly-wrapper .expiration-month-and-year',
		'.creditly-wrapper .credit-card-number',
		'.creditly-wrapper .security-code',
		'.creditly-wrapper .card-type');

	if($('#publication_type').find(":selected").text() == 'Gratuita') {
		$('.creditly-wrapper').css('display', 'none')
		$('.expiration-month-and-year').attr('required', false)
		$('.credit-card-number').attr('required', false)
		$('.security-code').attr('required', false)
		$('.billing-address-name').attr('required', false)
	}

	$("#property-form").submit(function(e) {
		if($('#publication_type').find(":selected").text() != 'Gratuita') {
		  var output = creditly.validate();
		  if (!output) {
			e.preventDefault();
		  }
		}
	});

	$("body").on("creditly_client_validation_error", function(e, data) {
	  alert(data["messages"].join(", "));
	});

	$('#publication_type').change(function(e) {
		if(this.options[e.target.selectedIndex].text == 'Gratuita') {
			$('.creditly-wrapper').css('display', 'none')
			$('.expiration-month-and-year').attr('required', false)
			$('.credit-card-number').attr('required', false)
			$('.security-code').attr('required', false)
			$('.billing-address-name').attr('required', false)
		}
		else {
			$('.creditly-wrapper').css('display', 'block')
			$('.expiration-month-and-year').attr('required', true)
			$('.credit-card-number').attr('required', true)
			$('.security-code').attr('required', true)
			$('.billing-address-name').attr('required', true)
		}
	})

})
