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
};

if($('#phase_6').checkbox('is checked'))
{
  $('#norme_table').show();
};


$('#saveChangesButton').click(function(event) {
    $.ajax({
    url: '/changePhasesRequest',
    type: 'POST',
    data: $('#phaseManagementForm').serialize(),
    success: function(data){
      if(data == 'true')
        alert("Standards has been successfuly updated");
      else alert("Please select at least one standard");
    }
  })
});
