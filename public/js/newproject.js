$('.menu .item')
  .tab()
;

$('.master.checkbox')
  .checkbox({

    // check all children
    onChecked: function() {
      var
        $childCheckbox  = $(this).closest('.checkbox').siblings('.list').find('.checkbox')
      ;
      $childCheckbox.checkbox('check');
    },
    // uncheck all children
    onUnchecked: function() {
      var
        $childCheckbox  = $(this).closest('.checkbox').siblings('.list').find('.checkbox')
      ;
      $childCheckbox.checkbox('uncheck');
    }
  })
;

$('.ui.master.checkbox.checked').checkbox('set checked');


$('.child.checkbox')
  .checkbox({
    // Fire on load to set parent value
    fireOnInit : true,
    // Change parent state on each child checkbox change
    onChange   : function() {
      var
        $listGroup      = $(this).closest('.list'),
        $parentCheckbox = $listGroup.closest('.item').children('.checkbox'),
        $checkbox       = $listGroup.find('.checkbox'),
        allChecked      = true,
        allUnchecked    = true
      ;
      // check to see if all other siblings are checked or unchecked
      $checkbox.each(function() {
        if( $(this).checkbox('is checked') ) {
          allUnchecked = false;
        }
        else {
          allChecked = false;
        }
      });
      // set parent checkbox state, but dont trigger its onChange callback
      if(allChecked) {
        $parentCheckbox.checkbox('set checked');
      }
      else if(allUnchecked) {
        $parentCheckbox.checkbox('set unchecked');
      }
      else {
        $parentCheckbox.checkbox('set indeterminate');
      }
    }
  })
;


$('.ui.master.checkbox.checked').checkbox('set checked');

$('.ui.checkbox').checkbox();
$('.ui.checkbox.checked').checkbox('set checked');

$('.ui.radio.checkbox')
  .checkbox()
;

$('#Next1').click(function() {
  var isValid;
  $("input[name^='Project']").each(function() {
     var element = $(this);
     if (element.val() == "") {
         isValid = false;
     }
  });
    if($("textarea[name^=Project").val() == "")
    {
      isValid = false;
    }
    
  if(isValid === false)
    alert('Please fill in all inputs!');
  else {
    $('#firsttabtitle').removeClass('active');
    $('#firsttabtitle').addClass('hidden');
    $('#secondtabtitle').addClass('active');
    $('#secondtabtitle').removeClass('disabled');
    $('#secondtab').removeClass('hidden');
    $('#firsttab').addClass('hidden');

    }
});

$('#Next2').click(function() {
    $('#secondtabtitle').removeClass('active');
    $('#secondtabtitle').addClass('hidden');
    $('#thirdtabtitle').addClass('active');
    $('#thirdtabtitle').removeClass('disabled');
    $('#thirdtab').removeClass('hidden');
    $('#secondtab').addClass('hidden');
});

$('#Previous1').click(function() {
    $('#firsttabtitle').addClass('active');
    $('#secondtabtitle').removeClass('active');
    $('#secondtab').addClass('hidden');
    $('#firsttab').removeClass('hidden');
});

$('#Previous2').click(function() {
    $('#secondtabtitle').addClass('active');
    $('#thirdtabtitle').removeClass('active');
    $('#thirdtab').addClass('hidden');
    $('#secondtab').removeClass('hidden');
});


$('#dateStart').calendar({
  type: 'date',
  endCalendar: $('#dateEnd')
});

$('#dateEnd').calendar({
  type: 'date',
  startCalendar: $('#dateStart')
});

$('#Design').checkbox({
    onChecked: function() {
      $('#toShow6').show();
      $('#toShow7').show();
    },
    onUnchecked: function() {
      $('#toShow6').hide();
      $('#toShow7').hide();
      $('#phase_6').checkbox('set unchecked');
      $('#phase_7').checkbox('set unchecked');
      $('#norme_table').hide();
      $('#norme_table table tr td').children('.checkbox').each(function(index, el) {
        $('#'+el.id+'').checkbox('set unchecked');
      });
    }
});


$('#phase_6').checkbox({
  onChecked: function() {
      $('#norme_table').show();
    },
    onUnchecked: function() {
      $('#norme_table').hide();
      $('#norme_table table tr td').children('.checkbox').each(function(index, el) {
        $('#'+el.id+'').checkbox('set unchecked');
      });
    }
});

if($('#phase_6').checkbox('is checked') || $('#phase_7').checkbox('is checked'))
{
  $('#Design').checkbox('set checked');
  $('#toShow6').show();
  $('#toShow7').show();
}

if($('#phase_6').checkbox('is checked'))
{
  $('#norme_table').show();
}


$(document).on('change paste keyup', '#organisation_name', function(event) {
  $('#intervenantsTable').html("");
  $org = $('#organisation_name').val();
    $td = '<td class="center aligned iceBG"><div class="ui radio checkbox ">';
    $colspan = '<td class="active" colspan=5></td>';
  $.ajax({
    url: '/getOrganisationIntervenants',
    type: 'GET',
    data: { 'orgname' : $org},
    success: function (data) {
      for (var i = data.length - 1; i >= 0; i--) {
          $fname = '<tr><td class="iceBG"><b>'+data[i].first_name+'</b></td>';
          $lname = '<td class="iceBG"><b>'+data[i].last_name+'</b></td>';
          $fct = '<td class="iceBG">'+data[i].fonction+'</td>';
          $org = '<td class="iceBG">'+data[i].organisation+'</td>';
          
          $inputM = $td+'<input name="role['+data[i].id+']" tabindex="0" class="hidden" type="radio" value="Manager"></div></td>';
          $inputPP = $td+'<input name="role['+data[i].id+']" tabindex="0" class="hidden" type="radio" value="Project Participant"></div></td>';
          $inputG = $td+'<input name="role['+data[i].id+']" tabindex="0" class="hidden" type="radio" value="Guest"></td></div></td>';
          $('#intervenantsTable').append($fname + $lname + $fct + $org + $colspan + $inputM + $inputPP + $inputG);        
      }
    }
  })
  .done(function() {
    $('.ui.radio.checkbox').checkbox();
  })
});



$('#submitform').click(function(event) {

  countLA = 0;
  countPM = 0;
  countApprover = 0;
  $("input[name^='role']").each(function() {
     var element = $(this).parent().checkbox('is checked');
     if (element && $(this).val() == "Lead Assessor") {
         countLA += 1;
     }else if (element && $(this).val() == "Project Manager") {
         countPM += 1;
     }else if (element && $(this).val() == "Approver") {
         countApprover += 1;
     }
  });
  if ($('#organisation_name').val() == "") {
      alert('Please select an organisation for this project.');
  }
  else if(countLA < 1)
    alert("You must select a Lead Assessor");
  else if(countPM > 1 || countApprover > 1 || countLA > 1 )
    alert("You must select one and only one Lead Assessor / Project Manager / Approver");
  else {
        if (confirm('Are you sure you want to create this project? ')) {
          $("#theForm").submit();
        }
  }

});


//    $("#theForm").submit();
