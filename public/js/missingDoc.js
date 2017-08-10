    $('#missingDocTable').DataTable({
          "pageLength": 5,
          "lengthMenu": [ 5, 10, 15 ],
          "bDestroy": true
    });

    $('#SubmitNewMissingDocAlert').click(function(event) {
        if(confirm('Are you sure you want to create this alert ?')){
        	$.ajax({
        		url: '/saveNewMissingDocAlert',
        		type: 'POST',
        		data: $("#formaddmissingdocalert").serialize(),
                success: function(data){
                    alert('Document Alert added!');
                    $('#showMissingDocument').trigger('click');
                }
        	})
        	.done(function() {
        		
        	})
            .fail(function() {
                alert('Please fill in all the blanks.');
            })
        }
    });


    $("#missingDocTable").on('click', '.DocFound', function(event) {
        if (confirm('Are you sure that this file is uploaded by the client?')) {
        	$id = $(this).data('doc');
        	$row = $(this).parent().parent();
        	$this = $(this);
        	$validate = $(this);
                $.ajax({
                    url: '/MissingDocAdded',
                    type: 'POST',
                    data: {
                        "id" : $id
                    },
                    success: function (data) {
                        
                    }
                }).done(function() {
                    $('#missingDocTable').DataTable().row($row).remove().draw();
                });
        }

    });