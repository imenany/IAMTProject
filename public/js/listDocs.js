$(".datatable").on('click', '.validate', function(event) {
	$id = $(this).data('doc');
	$validate = $(this);
	$remove = $(this).parent('td').children('.remove');

	$.ajax({
		url: '/validateDocument',
		type: 'POST',
		data: {"id" : $id},
		success: function (data) {
			
    	}
	}).done(function() {
		$('#loading_files').show();
		setTimeout(function() {
            $('#loading_files').fadeOut('fast');
        }, 650); 

		$validate.parent('td').parent('tr').removeClass('active');
		$validate.parent('td').children('div').show();
		$validate.remove();
		$remove.remove();
	});
});


$(".datatable").on('click', '.remove', function(event) {
	$id = $(this).data('doc');
	$ToValidate = $(this);
	$ToEdit = $(this).parent('td').children('.validate');
	$ToRemove = $(this).parent('td').parent('tr');

	$.ajax({
		url: '/rejectDocument',
		type: 'POST',
		data: {"id" : $id},
		success: function (data) {
			
    	}
	}).done(function() {
		$('#loading_files').show();
		setTimeout(function() {
            $('#loading_files').fadeOut('fast');
        }, 650); 
		$ToRemove.remove();
		$(".datatable").DataTable().row($ToRemove).remove().draw();

	});
});



$(".datatable").on('click', '.edit', function(event) {

	$div = '<div class="item" name="document[phase]" data-value="';
	$datatext = '" data-text="';
	$menu = $("#menu_normes");
	$menu.html("");
	$id = $(this).data('doc');
	$.ajax({
		url: '/editDocument',
		data: {'id': $id},
		type: 'GET',
		success: function (data) {
			console.log(data);
			$("input[name='document[title]']").val(data.document.title);
			$("input[name='document[id]']").val(data.document.id);
			$("input[name='document[version]']").val(data.document.version);
			$("input[name='document[phase]']").val(data.document.phase);
			
			for (var i = data.normes.length - 1; i >= 0; i--) {
				$menu.append($div+ data.normes[i].normesphase.id + $datatext + data.normes[i].normesphase.name +'" >' +data.normes[i].normesphase.name + '</div>')
			}

    	}
	})
	.done(function() {
		$('#EditDocument').modal('show');
		$('#EditDocument').on('click', '#SubmitChanges', function(event) {
			event.preventDefault();
		    $.ajax({
			      url: '/saveEditionDoc',
			      type: 'POST',
			      data: $('#edit_doc_form').serialize()
			    }).done(function() {
			    		$('#showallDocuments').trigger('click');
			    		$('#EditDocument').modal('hide');
					})
					.fail(function() {
						
					});
		});
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});
