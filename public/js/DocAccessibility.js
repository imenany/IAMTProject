$("#DocAccessibilityTable").on('click', '.hide', function(event) {
	$id = $(this).data('doc');
	$span = $(this).parent().parent().find('td:last').prev().children('span');
	$unhide = '<i class="unhide large icon link" data-doc="'+$id+'" ></i>';
	$alert = ''+$(this).parent().parent().find('td:first').html()+' has been hidden from the client';
	$this = $(this);
	if (confirm('Are you sure you want to hide this document?')) {
		$.ajax({
			url: '/hideDoc',
			type: 'POST',
			data: {
				"id" : $id
			},
			success: function (data) {
				alert($alert);
	    	}
		}).done(function() {
			$this.parent().html($unhide);
			$span.html("Hidden");
		});
	}
});


$("#DocAccessibilityTable").on('click', '.unhide', function(event) {
	$id = $(this).data('doc');
	$user = $(this).data('user');
	$span = $(this).parent().parent().find('td:last').prev().children('span');
	$this = $(this);
	$alert = ''+$(this).parent().parent().find('td:first').html()+' is now visible to the client';

	$hide = '<i class="hide large red link icon" data-doc="'+$id+'"></i>';
	if (confirm('Are you sure you want to unhide this document? ')) {
		$.ajax({
			url: '/showDoc',
			type: 'POST',
			data: {
				"id" : $id
			},
			success: function (data) {
				alert($alert);
	    	}
		}).done(function() {
			$this.parent().html($hide);
			$span.html("Visible");
		});
	}
});

