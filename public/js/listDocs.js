$("#ListOfDocuments").on('click', '.validate', function(event) {
	$id = $(this).data('doc');
	$validate = $(this);
	$remove = $(this).parent('td').children('.remove');
	var stop = false;
	if (confirm('Are you sure you want to approve this document ?')) {
		$.ajax({
			url: '/validateDocument',
			type: 'POST',
			data: {"id" : $id},
			success: function (data) {
				if(data == "false")
				{	stop = true;}
	    	}
		}).done(function() {
			if(stop == true)
			{
				alert('Please edit this document and specify a version and a phase');
				$validate.parent('td').children('.editshow').trigger('click');
			}
			else
			{
				$validate.parent('td').parent('tr').removeClass('active');
				$validate.parent('td').children('div').show();
				$validate.remove();
				$remove.remove();
			}
		});
	}
});


$("#ListOfDocuments").on('click', '.remove', function(event) {
	$id = $(this).data('doc');
	$ToValidate = $(this);
	$ToEdit = $(this).parent('td').children('.validate');
	$ToRemove = $(this).parent('td').parent('tr');
	if (confirm('Are you sure you want to reject this document ?')) {
		$.ajax({
			url: '/rejectDocument',
			type: 'POST',
			data: {"id" : $id},
			success: function (data) {
				
	    	}
		}).done(function() {
			
			$ToRemove.remove();
			$("#ListOfDocuments").DataTable().row($ToRemove).remove().draw();

		});
	}
});



$("#ListOfDocuments").on('click', '.edit', function(event) {

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
			$("input[name='document[version]']").attr('min', data.document.version);
			$("input[name='document[phase]']").val(data.document.phase);
			$("input[name='document[file]']").val('');
			
			for (var i = data.normes.length - 1; i >= 0; i--) {
				$menu.append($div+ data.normes[i].normesphase.id + $datatext + data.normes[i].normesphase.name +'" >' +data.normes[i].normesphase.name + '</div>')
			}

    	}
	})
	.done(function() {
		$('#EditDocument').modal('show');
		$('form#edit_doc_form').submit(function(event) {
				event.preventDefault();
				var formData = new FormData();
				$file = $("input[name='document[file]']");
				formData.append('file',$file[0].files[0]);
				formData.append('id',$("input[name='document[id]']").val());
				formData.append('version',$("input[name='document[version]']").val());
				formData.append('phase',$("input[name='document[phase]']").val());
				formData.append('title',$("input[name='document[title]']").val());

				$.ajax({
				      url: '/saveEditionDoc',
				      type: 'POST',
				      data: formData,
				      processData: false,
    				  contentType: false,
				      success: function(data){
				      	console.log(data);
				      }
				    }).done(function() {
				    		$('#showallDocuments').trigger('click');
				    		$('#EditDocument').modal('hide');
						})
		});
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});



  $('#ListOfDocuments').DataTable({
        "pageLength": 5,
        "lengthMenu": [ 5, 10, 15 ],
        "bDestroy": true,
        "autoWidth": false

  });
