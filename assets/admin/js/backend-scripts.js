/*------------------------ 
Backend related javascript
------------------------*/

(function( $ ) {

	"use strict";

	$(document).ready( function() {
		$.ajax({
			type : "post",
			dataType : "json",
			url : imarabinda.ajaxurl,
			data : {
				action: "my_demo_ajax_call", 
				demo_data : 'test_data', 
				ajax_nonce_parameter: imarabinda.security_nonce
			},
			success: function(response) {
				console.log( response );
			}
		});
	});


	// window load start
	$( window ).load(function() {
		
		
	
	
	
	
	
	
	
	});
	// window load end

})( jQuery );
