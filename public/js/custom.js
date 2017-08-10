   $('.close.icon').click(function(event) {
       $('.message').remove();
   });
   
    $('#doc_man').resize(function(event) {
        $('#files_reader').css('height', $(this).height()-80);
    });

    setTimeout(function() {
      $('#loading_files').fadeOut('fast');
    }, 500); 
    
    $('#new_project').click(function(event) {
      location.href = '/newProject';
    });

    $('#new_user').click(function(event) {
      location.href = '/newUser';
    });

    $('.datatable').DataTable({
      "pageLength": 5,
      "lengthMenu": [ 5, 10, 15 ],
      "bDestroy": true
    });

    $('.expand').click(function(event) {
        $(this).parent().parent().children("div.list").toggle();
    });

    $('.previewimage')
      .popup({
        position : 'right center'
    });

    $('.ui.radio.checkbox')
      .checkbox()
    ;


