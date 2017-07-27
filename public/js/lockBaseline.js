$(".datatable").on('click', '.open', function(event) {
	$id = $(this).data('baseline');
	$lock = '<i class="lock red large link icon lock" data-baseline="'+$id+'"></i><span class="lock">lock</span>';
	$.ajax({
		url: '/openBaselineRequest',
		type: 'POST',
		data: {"id" : $id},
		success: function (data) {
			
    	}
	}).done(function() {
		$('#loading_files').show();
		setTimeout(function() {
            $('#loading_files').fadeOut('fast');
        }, 650); 

		$('.open').parent().html($lock);
        $('.status').html('opened');

	});
});

$(".datatable").on('click', '.lock', function(event) {
	$id = $(this).data('baseline');
	$open = '<i class="check square green outline large link icon open" data-baseline="'+$id+'"></i><span class="open">open</span>'
	$.ajax({
		url: '/lockBaselineRequest',
		type: 'POST',
		data: {"id" : $id},
		success: function (data) {
			console.log(data);
    	}
	}).done(function() {
		$('#loading_files').show();
		setTimeout(function() {
            $('#loading_files').fadeOut('fast');
        }, 650); 

		$('.lock').parent().html($open);
        $('.status').html('locked');
	});
});