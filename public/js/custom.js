    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.ui.dropdown').dropdown();
    $('#hide_menu').click(function(event) {
        $('#left_menu').hide('fast', function() {
            console.log("hello");
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

   $('.close.icon').click(function(event) {
       $('.message').remove();
   });

   $('.show_file').click(function(event) {
            $url = $(this).data("url").replace("public/","");
            if($url.includes('.jpg') || $url.includes('.png') || $url.includes('.jpeg') || $url.includes('.bmp') || $url.includes('.csv') || $url.includes('.svg'))
              {
                $('#files_reader').html('<img src="storage/'+$url+'" alt="placeholder+image" id="image" data-zoom-image="storage/Desert.jpg">');
              }
            else if($url.includes('.pdf')){
                $('#files_reader').html('<object data="storage/'+$url+'" type="application/pdf" width="100%" height="100%"><p>Alternative text - include a link <a href="storage/download/pdffile.pdf">to the PDF!</a></p></object>');
            }
            else {
                $('#files_reader').html('<h4 class="class="header">This document is only available for download</h4><a href="storage/'+$url+'"><div class="ui button labeled icon large linkedin" tabindex="0"><i class="download icon"></i> Download</div></a>');
            }
            $last = $url.substring($url.lastIndexOf("/") + 1, $url.length);
            $title = $last + "<a download="+$last+" href='storage/"+$url+"'><i class='download icon'></i></a><a href='/deleteFile/"+$last+"'><i class='trash icon'></i></a>";
            $('#doc_title').html($title);

            $('#loading_preview').show();

            setTimeout(function() {
                $('#loading_preview').fadeOut('fast');
              }, 650); // <-- time in milliseconds

   });

    $('#doc_man').resize(function(event) {
        $('#files_reader').css('height', $(this).height()-30);
        //$('#left_menu').css('height',$(this).height() + $('#ISA').height() + 3*$('.top_menu').height() - 4);
        //$('#ISA').css('height',$('#left_menu').height() - $('#doc_man').height() - 3*$('.top_menu').height() + 5);
    });

    setTimeout(function() {
      $('#loading_files').fadeOut('fast');
    }, 500); // <-- time in milliseconds
    

    $('#new_project').click(function(event) {
        location.href = '/newProject';
    });


    $('.datatable').DataTable({
          "pageLength": 5,
          "lengthMenu": [ 5, 10, 15 ]
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