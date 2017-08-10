if($('#updateBaseline').data('exists') == 'opened')
{
  $('#new_baseline_modal').modal({
      closable  : false,
      onDeny    : function(){
          $('#showallBaselines').trigger('click');
          $('#new_baseline_modal').modal('hide'); 
        return false;
      },
      onApprove : function() {
        //alert('Baseline Locked');
          $.ajax({
            url: '/lockBaselineRequest',
            type: 'POST',
            success: function (data) {
              alert('The previous Baseline is now locked.');
            }
          })
      }
      })
      .modal('show')
}

$('#addDocument').click(function(event) {

    $row = $('#newBaseline tr').length - 1;
    $name = "field"+$row;

    $('#docsTableBody').append('<tr class="hidden"> <td> <div class="ui stacked"> <div class="field"> <div class="ui left icon input"> <div class="ui small action input"> <input type="file" name="field['+$row+'][file]" id="'+$name+'" required> </div> </div> </div> </td>   </tr>');
    $('#docsTableBody').append('<tr><td><div class="ui fluid action input">   <input type="text" disabled id="hidden'+$name+'">   <div class="ui button">Browse</div> </div></td><td width="100"><div class="field"><label>Version</label><input name="field['+$row+'][version]" type="number" step="0.1"></div></td> </tr>');
    $target = "#"+$name;
    $($target).trigger('click');
    
    $($target).on('input', function() { 
      $("#hidden"+$name).val($(this).val());
    });

});

$('#browse0').click(function(event) {
    $('#hidden_field1').trigger('click');

});

$('#hidden_field1').on('input', function() { 
    $('#field[1][file]').val($(this).val());
});


