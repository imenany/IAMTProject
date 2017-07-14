if($('#updateBaseline').data('exists') == 'opened')
{
  $('#new_baseline_modal').modal({
      closable  : false,
      onDeny    : function(){
          history.go(-1);
        return false;
      },
      onApprove : function() {
        //alert('Baseline Locked');
          $.ajax({
            url: '/lockBaselineRequest',
            type: 'POST',
            success: function (data) {
            }
          })
      }
      })
      .modal('show')
}

$('#addDocument').click(function(event) {

    $row = $('#newBaseline tr').length - 1;
    $name = "field"+$row;

    $('#docsTableBody').append('<tr class="hidden"> <td> <div class="ui stacked"> <div class="field"> <div class="ui left icon input"> <div class="ui small action input"> <input type="file" name="'+$name+'" id="'+$name+'" required> </div> </div> </div> </td>   </tr>');
    $('#docsTableBody').append('<tr><td><div class="ui fluid action input">   <input type="text" disabled id="hidden'+$name+'">   <div class="ui button">Browse</div> </div></td></tr>');
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
    $('#field1').val($(this).val());
});
