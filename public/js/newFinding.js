$('#SubmitChanges').click(function(event) {
      $.ajax({
        url: '/savefindingRequest',
        type: 'POST',
        data: $('#formaddfinding').serialize(),
        success: function (data) {
        	alert('Your finding has been added!');
        }
    }).done(function() {
        $('#showAllFindings').trigger('click');
    })
});