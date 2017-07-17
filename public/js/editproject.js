$(".selectNorme").dropdown({
    onChange: function (val) {
    	$("#snp").trigger('click');
        $.ajax({
        	url: '/getphases',
        	data: { 'id' : val },
        	success: function (data) {
        		$('.selectNormePhase').dropdown('set selected', '');
        		for (var i = 0; i < data.length; i++) {
        			document.getElementById("snp").insertAdjacentHTML('beforeend','<option value="'+data[i].id+'" selected="true">'+data[i].name+'</option>');
        		}
        	},
        })
    }
});


$(".selectNormePhase").dropdown({
    onChange: function (val) {
    	$("#snps").trigger('click');
        $.ajax({
        	url: '/getphasestep',
        	data: { 'id' : val },
        	success: function (data) {
        		$('.selectNormePhase').dropdown('set selected', '');
        		for (var i = 0; i < data.length; i++) {
        			document.getElementById("snps").insertAdjacentHTML('beforeend','<option value="'+data[i].id+'" selected="true">'+data[i].name+'</option>');
        		}
        	},
        })
    }
});


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


$('.list .child.checkbox')
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
  $("input[name^='Proj']").each(function() {
     var element = $(this);
     if (element.val() == "") {
         isValid = false;
     }
  });
  if(isValid === false)
    $('#message').show();
  else {
    $('#message').hide();
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

var $items ="";

$('#addNew').click(function(event) {
    $('#addNew').addClass('disabled');
    $tr = '<tr id="newRow">';
    $editable = '<td colspan="4"><div class="editable"><div class="field">'
    $select = '<select class="ui fluid search dropdown" name="user" id="appendable">';
    //$td = '<td class="center aligned"><div class="ui radio checkbox">';
    //$input = '<input name="role[]" tabindex="0" class="hidden" type="radio" value="Admin">';
      //</div><div></td>' + $td + $input + '</div></td></tr>');
    $id = $('#projectid').val();
    console.log($id);
    //$('.editable').html('<input type="text">');
        $.ajax({
            url: '/listIntervenantsRequest',
            type: 'GET',
            data: {'projectid' : $id },
            success: function (data) {

                $.each(data,function(index, intervenant) {
                       $items += '<option value="'+intervenant.id+'" ">'+intervenant.first_name+' '+intervenant.last_name+'</option>';
                });
            }
        })
        .done(function() {
            $('tbody').append($tr + $editable + $select +$items+ '</select></td>');  
            $items="";
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
});


$(document).on('change','#appendable ',function(){
  var x = this.options[this.selectedIndex].value;
  $(this).closest('tr').remove();
  $('#addNew').removeClass('disabled');
  $td = '<td class="center aligned iceBG"><div class="ui radio checkbox ">';
  $AI_ORG = '<td colspan="5" class="active"></td>';
  $C_ORG = '<td colspan="3" class="active"></td>';
  $.ajax({
            url: '/getIntervenantRequest',
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
              $delete = '<td class="center aligned iceBG"><div class="ui radio checkbox"><input tabindex="0" class="hidden" type="radio" value="null" name="role['+data.id+']"></div><i class="remove user red icon"></i></td></tr>';
              
              
              if(data.fonction == "AI_ORG")
                $('tbody').append($fname + $lname + $fct + $org + $inputLA + $inputA + $inputPM + $inputQA + $inputApprover + $C_ORG + $delete);
              else 
                $('tbody').append($fname + $lname + $fct + $org + $AI_ORG + $inputM + $inputPP + $inputG + $delete);

            }
        }).done(function() {
            $('.ui.radio.checkbox').checkbox();
        })


});



$('.Save').click(function(event) {
  $('#Saving').show();
    setTimeout(function() {
      $('#Saving').fadeOut('fast');
    }, 300); // <-- time in milliseconds
    
    $data = $('#formedit').serialize();
    $.ajax({
      url: '/saveitRequest',
      type: 'POST',
      data: $('#formedit').serialize(),
      success: function (data) {
      }
    })
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

