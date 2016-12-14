<!-- Footer -->
  <div class="row">
  	<hr>
    
    <div class="text-center col-md-6 col-md-offset-3">
      <h4>Contact Us</h4>
      <p>Copyright &copy; 2016 &middot; All Rights Reserved &middot; <a href="#" >Email Administrator</a></p>
    </div>
  </div>
  
  
  
</body>
<script>
  // Init the JS libraries
  $.material.init();
  $.material.ripples();
  $.material.input();
  
  // Every page will have
  $(document).ready(function() {
	 
	 // Autocomplete listeners for search
	 $('#navbarSearch').autocomplete({
		autoFocus: true,
		source: function(request, response) {
        $.ajax({
            url: 'testInput.php',
            dataType: "json",
            data: {
                term: request.term,
                inputType: 'search'
            },
            success: function(data) {
                response(data);
            }
        });
    	},
		minLength: 1
	});
	

   });
   
	// A function to call to create a alert message
	function bootstrapAlert(text, bootstrapClass) {  
		var divTemp =  "<div class='alert alert-dismissible alert-" + bootstrapClass + " error-message' style='display:none'>"
		var message = $(divTemp); 
		var closeButton = $("<button type='button' class='close' data-dismiss='alert'>×</button>");
		
		// Pin alert to well
		var well = $('.well').first();
		var wellOff = well.offset();
		var wellL = wellOff.left + 30;
		var wellT = wellOff.top + 25;
		var wellW = well.width() - 30;
		
		
		message.append(closeButton);
		message.append(text);
		
		message.appendTo($('body'))
			.fadeIn(300)
			.delay(5000)
			.css({
				'display': 'block',
				'position': 'fixed',
				'width': wellW, 	//'75%',
				'left': wellL, //50%
				'margin': '0 auto',
				'top': wellT
			}
		);
	}
	
	function phpCallback(text) {
		var message = {'message': text};
		
		$.ajax({
			type: "POST",
			url: "testInput.php?inputType=test",
			data: message,
			dataType:"json",
			success: function(data) { bootstrapAlert(data.message, data.class); },
	  });
	}
</script>


</html>
