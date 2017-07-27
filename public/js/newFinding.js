$('#SubmitChanges').click(function(event) {
      $.ajax({
        url: '/savefindingRequest',
        type: 'POST',
        data: $('#formaddfinding').serialize(),
        success: function (data) {
        }
    }).done(function() {
        $('#showAllFindings').trigger('click');
    })
});