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
		$('#message').show();
	else {
		$('#message').hide();

	    $data = $('#form').serialize();
	    $.ajax({
	      url: '/saveNewUser',
	      type: 'POST',
	      data: $('#form').serialize()
	    }).done(function() {
	    	$('#user_saved_modal')
			    .modal({
			        closable  : false,
			        onDeny: function(){
			        	location.href = "/listUsers";
			        },
			        onApprove: function(){
			        	location.href = "/newUser";
			        }
			    })
			    .modal('show');
			})
			.fail(function() {
				$('#email_already_taken').modal('show');
			})
	}

});
