  $("#findingstable").on('click', '.more', function(event) {
      $id = $(this).data('finding');
      $.post('/displayFinding',{ 'id' : $id }, function(data, textStatus, xhr) {
            $("#ISA_content").html(data);
      });
  });

    $('#Loading').show();
    setTimeout(function() {
        $('#Loading').fadeOut('fast');
    }, 20);

  $("#findingstable").on('click', '.response', function(event) {

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
                          $("input[name='finding[finding]']").val(data.finding.finding);
                          $("input[name='id']").val(data.finding.id);
                          $("textarea[name='finding[description]']").val(data.finding.description);
                          $("textarea[name='finding[recommendation]']").val(data.finding.recommendation);
                          $("select[name='finding[document]']").html("");
                          $("select[name='finding[responsable]']").html("");
                          $.each(data.pparticipant, function (i, item) {
                              $("select[name='finding[responsable]']").append($('<option>', { 
                                  value: item.user.id,
                                  text : item.user.first_name+' '+item.user.last_name 
                              }));
                          });

                          $.each(data.documents, function (i, item) {
                              $("select[name='finding[document]']").append($('<option>', { 
                                  value: item.id,
                                  text : item.title 
                              }));
                          });


                          $("select[name='finding[severity]']").val(data.finding.severity);
                          $("select[name='finding[responsable]']").val(data.finding.responsable);
                          $("select[name='finding[document]']").val(data.finding.document_id);
                        }
                    });
                  },
        onApprove : function() {
                    if (confirm('Are you sure you want to send this response?')) {
                      $.ajax({
                        url: '/saveFindingResponse',
                        type: 'POST',
                        data: $('#response_finding_form').serialize(),
                        success: function (data){
                          $('#Saving').show();
                          setTimeout(function() {
                              $('#Saving').fadeOut('fast');
                          }, 200);
                          alert('Your response has been saved, you will get the assessors response as soon as possible.');
                        }
                      }).done(function() {
                          $('#showAllFindings').trigger('click');
                      });
                    }

                  }
    }).modal('show');
});


  $("#findingstable").on('click', '.responseA', function(event) {
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
                          $("input[name='finding[findingA]']").val(data.finding.finding);
                          $("input[name='idA']").val(data.finding.id);
                          $("textarea[name='finding[descriptionA]']").val(data.finding.description);
                          $("textarea[name='finding[recommendationA]']").val(data.finding.recommendation);
                          $("select[name='finding[documentA]']").html("");
                          $("select[name='finding[responsableA]']").html("");
                          $.each(data.pparticipant, function (i, item) {
                              $("select[name='finding[responsableA]']").append($('<option>', { 
                                  value: item.user.id,
                                  text : item.user.first_name+' '+item.user.last_name 
                              }));
                          });

                          $.each(data.documents, function (i, item) {
                              $("select[name='finding[documentA]']").append($('<option>', { 
                                  value: item.id,
                                  text : item.title 
                              }));
                          });

                          $("select[name='finding[severityA]']").val(data.finding.severity);
                          $("select[name='finding[responsableA]']").val(data.finding.responsable);
                          $("select[name='finding[documentA]']").val(data.finding.document_id);
                        }
                    });
                  },
        onApprove : function() {
                    if (confirm('Are you sure you want to send this response?')) {
                      $.ajax({
                        url: '/saveFindingResponseA',
                        type: 'POST',
                        data: $('#responseA_finding_form').serialize(),
                        success: function (data){
                          $('#Saving').show();
                          setTimeout(function() {
                              $('#Saving').fadeOut('fast');
                          }, 200);                          
                          alert('Your response has been saved, it will be reviewed as soon as possible.');
                        }
                      }).done(function() {
                          $('#showAllFindings').trigger('click');
                      });
                    }
                  }
    }).modal('show');

  });

  $("#findingstable").on('click', '.editFinding', function(event) {
    $id = $(this).data('finding');

    $('#editFindingModal').modal({
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
                          $("input[name='finding[newfinding]']").val(data.finding.finding);
                          $("input[name='theid']").val(data.finding.id);
                          $("textarea[name='finding[newdescription]']").val(data.finding.description);
                          $("textarea[name='finding[newrecommendation]']").val(data.finding.recommendation);
                          $("select[name='finding[newdocument]']").html("");
                          $("select[name='finding[newresponsable]']").html("");
                          $.each(data.pparticipant, function (i, item) {
                              $("select[name='finding[newresponsable]']").append($('<option>', { 
                                  value: item.user.id,
                                  text : item.user.first_name+' '+item.user.last_name 
                              }));
                          });

                          $.each(data.documents, function (i, item) {
                              $("select[name='finding[newdocument]']").append($('<option>', { 
                                  value: item.id,
                                  text : item.title 
                              }));
                          });


                          $("select[name='finding[newseverity]']").val(data.finding.severity);
                          $("select[name='finding[newresponsable]']").val(data.finding.responsable);
                          $("select[name='finding[newdocument]']").val(data.finding.document_id);
                        }
                    });
                  },
        onApprove : function() {
                    if (confirm('Are you sure you want to save these moddifications?')) {
                      $.ajax({
                        url: '/saveFindingModification',
                        type: 'POST',
                        data: $('#modify_finding_form').serialize(),
                        success: function (data){
                          $('#Saving').show();
                          setTimeout(function() {
                              $('#Saving').fadeOut('fast');
                          }, 200);
                          alert('Your modification has been saved.');
                        }
                        }).done(function() {
                          $('#showAllFindings').trigger('click');
                      });
                    }
                  }
    }).modal('show');

  });



  $("#findingstable").on('click', '.validate', function(event) {
    if(confirm('Are you sure you want to validate this finding?'))
    {
      $id = $(this).data('finding');
      $validate = $(this);
      $remove = $(this).parent('td').children('.remove');

      $.ajax({
        url: '/validateFinding',
        type: 'POST',
        data: {'id': $id},
        success: function(){
        $('#Saving').show();
        setTimeout(function() {
            $('#Saving').fadeOut('fast');
        }, 200);
          alert("Finding validated!");
        }
      })
      .done(function() {
        $validate.parent('td').parent('tr').removeClass('active');
        $validate.parent('td').children('div').show();
        $validate.remove();
        $remove.remove();
      });
    }
  });

  $("#findingstable").on('click', '.remove', function(event) {
    if(confirm('Are you sure you want to remove this finding?'))
    {
      $id = $(this).data('finding');
      $ToValidate = $(this);
      $ToEdit = $(this).parent('td').children('.validate');
      $ToRemove = $(this).parent('td').parent('tr');

      $.ajax({
        url: '/rejectFinding',
        type: 'POST',
        data: {'id': $id},
        success: function(){
          $('#Saving').show();
          setTimeout(function() {
              $('#Saving').fadeOut('fast');
          }, 200);
        }
      })
      .done(function() {
        $ToRemove.remove();
        $('#showAllFindings').trigger('click');
      })
    }
  });





  $('#generateROBSPDFButton').click(function(event) {
    $.ajax({
      url: '/generateROBSPDF',
      data: $('#GenerateROBSForm').serialize(),
      success: function (data) {
        $('#Loading').show();
        setTimeout(function() {
            $('#Loading').fadeOut('fast');
        }, 20);
        $url = data.replace("public/","");
        $('#download').attr({
          href: "/storage/"+$url,
        });
      }
    })
    .done(function() {
      $("#download span").trigger("click");
    });
    
  });

    $('#generateROBSXLSButton').click(function(event) {
    $.ajax({
      url: '/generateROBSXLS',
      data: $('#GenerateROBSForm').serialize(),
      success: function (data) {
        $('#Loading').show();
        setTimeout(function() {
            $('#Loading').fadeOut('fast');
        }, 20);
        $url = data.replace("public/","");
        $('#download').attr({
          href: "/storage/"+$url,
        });
      }
    })
    .done(function() {
      $("#download span").trigger("click");
    });
    
  });




  $('#findingstable').DataTable({
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



