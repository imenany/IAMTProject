$("#BaselinesLockTable").on('click', '.open', function(event) {
	if(confirm("Are you sure you want to open this baseline ?"))
	{
		$('#Saving').show();

		$id = $(this).data('baseline');
		$lock = '<i class="lock red large link icon lock" data-baseline="'+$id+'"></i><span class="lock">lock</span>';
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

				$('.open').parent().html($lock);
		        $('.status').html('opened');

			});
	}
});

$("#BaselinesLockTable").on('click', '.lock', function(event) {
	if(confirm("Are you sure you want to lock this baseline ?"))
	{
		$('#Saving').show();

		$id = $(this).data('baseline');
		$open = '<i class="check square green outline large link icon open" data-baseline="'+$id+'"></i><span class="open">open</span>';
			$.ajax({
				url: '/lockBaselineRequest',
				type: 'POST',
				data: {"id" : $id},
				success: function (data) {
					console.log(data);
		    	}
			}).done(function() {
				setTimeout(function() {
		            $('#Saving').fadeOut('fast');
		        }, 20); 

				$('.lock').parent().html($open);
		        $('.status').html('locked');
			});
	}});

