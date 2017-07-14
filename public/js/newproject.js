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

