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
		alert("Please fill in all inputs!");
	else {

		$('#Saving').show();
	    setTimeout(function() {
	      $('#Saving').fadeOut('fast');
	    }, 300); // <-- time in milliseconds
	    
	    $data = $('#formedit').serialize();
	    if (confirm('Are you sure you want to save these modifications? ')) {
		    $.ajax({
		      url: '/saveuserEditRequest',
		      type: 'POST',
		      data: $('#form').serialize(),
		      success: function (data) {
		      	alert('Your modifcation has been saved.');
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
		
	}

});
