function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};


$('#SaveUser').click(function(event) {

	event.preventDefault();
	var isValid;
	$("input[name^='user']").each(function() {
		 var element = $(this);
		 if (element.val() == "") {
		     isValid = false;
		 }
	});
	console.log($("input[name='user[email]']").val());
	if(!isValidEmailAddress($("input[name='user[email]']").val()))
	{
	 	isValid = false;
	}

	if(isValid === false)
		alert('Please fill in all inputs');

	else {
			$('#Saving').show();

	    $.ajax({
	      url: '/saveNewUser',
	      type: 'POST',
	      data: $('#form').serialize(),
	      success: function (data) {
	          alert('User has been saved.');
	          location.href = '/listUsers';
	      }
        }).done(function() {
        	$('#Saving').hide();
		})
		.fail(function() {
			$('#Saving').hide();
			alert('This is email is already taken, please try again with a new email. Thank you.');
		})
	}

});
