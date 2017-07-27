  $(".datatable").on('click', '.more', function(event) {
      $id = $(this).data('finding');
      $.post('/displayFinding',{ 'id' : $id }, function(data, textStatus, xhr) {
            $("#ISA_content").html(data);
      });
  });

  $(".datatable").on('click', '.response', function(event) {

    $id = $(this).data('finding');
    $('#addResponseModal').modal({
        selector : {
                    close    : '.close, .actions .button',
                    approve  : '.save',
                    deny     : '.actions .negative, .actions .deny, .actions .cancel'
                  },
        onShow : function() {
                    $.ajax({
                      url: '/getFindingData',
                      data: {'id': $id},
                      type: 'GET',
                      success: function (data) {
                          $("textarea[name='description']").val(data.description);
                          $("textarea[name='recommendation']").val(data.recommendation);
                          $("textarea[name='response']").val("");
                          $("input[name='id']").val(data.id);
                          $("#finding_name").html(data.finding);
                        }
                    });
                  },
        onApprove : function() {
                      $.ajax({
                        url: '/saveFindingResponse',
                        type: 'POST',
                        data: $('#response_finding_form').serialize()
                      }).done(function() {
                          $('#showAllFindings').trigger('click');
                      });

                  }
    }).modal('show');
});


  $(".datatable").on('click', '.responseA', function(event) {
    $id = $(this).data('finding');

    $('#addResponseAModal').modal({
        selector : {
                    close    : '.close, .actions .button',
                    approve  : '.save',
                    deny     : '.actions .negative, .actions .deny, .actions .cancel'
                  },
        onShow : function() {
                    $.ajax({
                      url: '/getFindingData',
                      data: {'id': $id},
                      type: 'GET',
                      success: function (data) {
                          $("textarea[name='responseA']").val(data.response);
                          $("textarea[name='recommendationA']").val("");
                          $("textarea[name='descriptionA']").val("");
                          $("input[name='id']").val(data.id);
                          $("#finding_nameA").html(data.finding);
                        }
                    });
                  },
        onApprove : function() {
                      $.ajax({
                        url: '/saveFindingResponseA',
                        type: 'POST',
                        data: $('#responseA_finding_form').serialize()
                      }).done(function() {
                          $('#showAllFindings').trigger('click');
                      });

                  }
    }).modal('show');

  });


  $('.datatable').DataTable({
        "pageLength": 5,
        "lengthMenu": [ 5, 10, 15 ],
        "bDestroy": true,
        "order": [[ 7, "desc" ]]
  });


  var recommendations = $('*[id^="recommendation"]');
  var descriptions = $('*[id^="description"]');


  recommendations.each(function(index, el) {
      $(el).popup({
        inline: true,
        on: 'hover',  
        position: 'bottom center'
    });
  });

  descriptions.each(function(index, el) {
      $(el).popup({
        inline: true,
        on: 'hover',
        position: 'bottom center'
    });
  });