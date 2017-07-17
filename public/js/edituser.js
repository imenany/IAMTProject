$('#SubmitChanges').click(function(event) {
	event.preventDefault();
	  var isValid;
	$("input[name^='user']").each(function() {
	 var element = $(this);
	 if (element.val() == "") {
	     isValid = false;
	 }
	});

	if(isValid === false)
		$('#message').show();
	else {
		$('#message').hide();

		$('#Saving').show();
	    setTimeout(function() {
	      $('#Saving').fadeOut('fast');
	    }, 300); // <-- time in milliseconds
	    
	    $data = $('#formedit').serialize();
	    $.ajax({
	      url: '/saveuserEditRequest',
	      type: 'POST',
	      data: $('#form').serialize(),
	      success: function (data) {
	      	console.log(data);
	      }
	    }).done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		
	}

});
