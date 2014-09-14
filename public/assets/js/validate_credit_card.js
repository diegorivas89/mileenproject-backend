$(document).ready(function(){

	creditly = Creditly.initialize(
	    '.creditly-wrapper .expiration-month-and-year',
	    '.creditly-wrapper .credit-card-number',
	    '.creditly-wrapper .security-code',
	    '.creditly-wrapper .card-type');

		$("#property-form").submit(function(e) {
		  var output = creditly.validate();
		  if (!output) {
		  	e.preventDefault();
		  }
		});

	$("body").on("creditly_client_validation_error", function(e, data) {
	  alert(data["messages"].join(", "));
	});

	$('#publication_type').change(function(e) {
		if(this.options[e.target.selectedIndex].text) {
			$('.creditly-wrapper').css('display', 'none')
		}
		else {
			$('.creditly-wrapper').css('display', 'block')
		}
	})

})
