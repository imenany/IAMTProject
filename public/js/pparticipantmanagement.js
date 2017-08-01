var $items ="";

$('#addNew').click(function(event) {
    event.preventDefault();
  
    var x = $('#newintervenants').val();
        $td = '<td class="center aligned iceBG"><div class="ui radio checkbox ">';
        $AI_ORG = '<td colspan="5" class="active"></td>';
        $C_ORG = '<td colspan="3" class="active"></td>';
        $.ajax({
            url: '/getProjectIntervenantRequest',
            type: 'GET',
            data: { id : x },
            success: function (data) {
              $fname = '<tr><td class="iceBG"><b>'+data.first_name+'</b></td>';
              $lname = '<td class="iceBG"><b>'+data.last_name+'</b></td>';
              $fct = '<td class="iceBG">'+data.fonction+'</td>';
              $org = '<td class="iceBG">'+data.organisation+'</td>';
              $inputLA = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Lead Assessor"></div></td>';
              $inputA = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Assessor"></div></td>';
              $inputPM = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Project Manager"></div></td>';
              $inputQA = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="QA"></div></td>';
              $inputApprover = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Approver"></div></td>';
              $inputM = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Manager"></div></td>';
              $inputPP = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Project Participant"></div></td>';
              $inputG = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Guest"></td></div></td>';
              $delete = '<td class="center aligned iceBG"><div class="ui radio checkbox"><input tabindex="0" class="hidden" type="radio" value="delete" name="role['+data.id+']"></div><i class="remove user red icon"></i></td></tr>';
              
              if(data.fonction == "AI_ORG")
                $('#tablesort').append($fname + $lname + $fct + $org + $inputLA + $inputA + $inputPM + $inputQA + $inputApprover + $C_ORG + $delete);
              else 
                $('#tablesort').append($fname + $lname + $fct + $org + $AI_ORG + $inputM + $inputPP + $inputG + $delete);

            }
        }).done(function() {
            $('.ui.radio.checkbox').checkbox();
        });

});


$(document).on('change paste keyup','#appendable ',function(){
  $('#intervenantsTable').html("");

  var x = this.options[this.selectedIndex].value;
  $(this).closest('tr').remove();
  $('#addNew').removeClass('disabled');
  $td = '<td class="center aligned iceBG"><div class="ui radio checkbox ">';
  $AI_ORG = '<td colspan="5" class="active"></td>';
  $C_ORG = '<td colspan="3" class="active"></td>';
  $.ajax({
            url: '/getProjectIntervenantRequest',
            type: 'GET',
            data: { id : x },
            success: function (data) {
              $fname = '<tr><td class="iceBG"><b>'+data.first_name+'</b></td>';
              $lname = '<td class="iceBG"><b>'+data.last_name+'</b></td>';
              $fct = '<td class="iceBG">'+data.fonction+'</td>';
              $org = '<td class="iceBG">'+data.organisation+'</td>';
              $inputLA = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Lead Assessor"></div></td>';
              $inputA = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Assessor"></div></td>';
              $inputPM = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Project Manager"></div></td>';
              $inputQA = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="QA"></div></td>';
              $inputApprover = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Approver"></div></td>';
              $inputM = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Manager"></div></td>';
              $inputPP = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Project Participant"></div></td>';
              $inputG = $td+'<input name="role['+data.id+']" tabindex="0" class="hidden" type="radio" value="Guest"></td></div></td>';
              $delete = '<td class="center aligned iceBG"><div class="ui radio checkbox"><input tabindex="0" class="hidden" type="radio" value="delete" name="role['+data.id+']"></div><i class="remove user red icon"></i></td></tr>';
              
              if(data.fonction == "AI_ORG")
                $('#intervenantsTable').append($fname + $lname + $fct + $org + $inputLA + $inputA + $inputPM + $inputQA + $inputApprover + $C_ORG + $delete);
              else 
                $('#intervenantsTable').append($fname + $lname + $fct + $org + $AI_ORG + $inputM + $inputPP + $inputG + $delete);

            }
        }).done(function() {
            $('.ui.radio.checkbox').checkbox();
        });


});



$('.Save').click(function(event) {
  $("input[name^='role']").each(function() {
     var element = $(this).parent().checkbox('is checked');
     if (element && $(this).val() == "delete") {
         $(this).parent().parent().parent().remove();
    }
  });


    $countLA = 0;
    $countPM = 0;
    $countApprover = 0;

    $("input[name^='role']").each(function() {
       var element = $(this).parent().checkbox('is checked');
       if (element && $(this).val() == "Lead Assessor") {
           $countLA += 1;
       }else if (element && $(this).val() == "Project Manager") {
           $countPM += 1;
       }else if (element && $(this).val() == "Approver") {
           $countApprover += 1;
       }
    });

    if($countLA == 1) {
        $('#Saving').show();
        setTimeout(function() {
          $('#Saving').fadeOut('fast');
          }, 300); // <-- time in milliseconds
          
          $data = $('#formedit').serialize();
          $.ajax({
            url: '/changeProjectParticipants',
            type: 'POST',
            data: $('#pparticipantManagementForm').serialize(),
            success: function (data) {
              if(data = 'true')
                alert('Project participants have been updated');
              else alert('There"s something wrong');
            }
          })
    } 
    else if($countPM >1 || $countApprover >1 )
      alert("You must select one and only one Lead Assessor / Project Manager / Approver");
    else {
      $('#Saving').show();
        setTimeout(function() {
          $('#Saving').fadeOut('fast');
          }, 300); // <-- time in milliseconds
          
          $data = $('#formedit').serialize();
          $.ajax({
            url: '/changeProjectParticipants',
            type: 'POST',
            data: $('#pparticipantManagementForm').serialize(),
            success: function (data) {
            }
          })
    }

  
});
