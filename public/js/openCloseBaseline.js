$(".datatable").on('click', '.open', function(event) {
	if(confirm("Are you sure you want to open this baseline ?"))
	{
		$('#Saving').show();
		$id = $(this).data('baseline');
		$close = '<i class="minus square red large link icon close" data-baseline="'+$id+'"></i><span class="close">close</span>';
		$.ajax({
			url: '/openBaselineRequest',
			type: 'POST',
			data: {"id" : $id},
			success: function (data) {
				
	    	}
		}).done(function() {
			setTimeout(function() {
	            $('#Saving').fadeOut('fast');
	        }, 20); 

			$('.open').parent().html($close);
	        $('.status').html('opened');

		});
	}
});

$(".datatable").on('click', '.close', function(event) {
	if(confirm("Are you sure you want to close this baseline ?"))
	{
		$('#Saving').show();
		$id = $(this).data('baseline');
		$open = '<i class="check square green outline large link icon open" data-baseline="'+$id+'"></i><span class="open">open</span>'
		$.ajax({
			url: '/closeBaselineRequest',
			type: 'POST',
			data: {"id" : $id},
			success: function (data) {
				console.log(data);
	    	}
		}).done(function() {
			setTimeout(function() {
	            $('#Saving').fadeOut('fast');
	        }, 20); 

			$('.close').parent().html($open);
	        $('.status').html('closed');
		});
	}
});