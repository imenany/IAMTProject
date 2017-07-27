    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.ui.dropdown').dropdown();
    $('#hide_menu').click(function(event) {
        $('#left_menu').hide('fast', function() {
            $('#left_menu_div').show('fast', function() {});
        });
     });

    $('#show_menu').click(function(event) {
        $('#left_menu_div').hide('fast', function() {
            $('#left_menu').show('fast', function() {});
        });
     });

    $('#show_isa').click(function(event) {
        $('#ISA').toggle("fast");
        $(this).toggleClass('ascending');
        $('#doc_man').toggleClass('showen');
    });

    $('#show_man').click(function(event) {
        $('#doc_man').toggle("fast");
        $(this).toggleClass('ascending');
        $('#ISA').toggleClass('showen');
    });

    $('#settings').click(function(event) {
        $('#settings_modal').modal('setting', 'transition', 'vertical  flip').modal('show');
    });