    $('#showNewBaseline').click(function(event) {
        $.post('/newBaseline', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showopencloseBaseline').click(function(event) {
        $.post('/opencloseBaseline', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showuploadFile').click(function(event) {
        $.post('/uploadFile', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showlockBaseline').click(function(event) {
        $.post('/lockBaseline', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showuploadFile2').click(function(event) {
        $.post('/uploadFile', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showviewDocuments').click(function(event) {
        $.post('/viewDocuments', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showmodifyDocuments').click(function(event) {
        $.post('/modifyDocuments', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showallDocuments').click(function(event) {
        $.post('/allDocuments', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });
    
    $('#showallDocuments2').click(function(event) {
        $.post('/allDocuments', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showmodifyDocuments').click(function(event) {
        $.post('/allDocuments', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });

    $('#showallBaselines').click(function(event) {
        $.post('/allBaselines', function(data, textStatus, xhr) {
            $("#doc_man_content").html(data);
        });
    });



    $('#showAllFindings').click(function(event) {
        $.post('/allFindings', function(data, textStatus, xhr) {
            $("#page_title").html("Show All Findings");
            $("#ISA_content").html(data);
        });
    });

    $('#showAddFinding').click(function(event) {
        $.post('/addFinding', function(data, textStatus, xhr) {
            $("#page_title").html("Add a finding");
            $("#ISA_content").html(data);
        });
    });

    $('#showModifyFinding').click(function(event) {
        $.post('/modifyFinding', function(data, textStatus, xhr) {
            $("#page_title").html("Modify a finding");
            $("#ISA_content").html(data);
        });
    });

    $('#showModifiedFindings').click(function(event) {
        $.post('/modifiedFindings', function(data, textStatus, xhr) {
            $("#page_title").html("Modified findings");
            $("#ISA_content").html(data);
        });
    });

    $('#showCreateRobs').click(function(event) {
        $.post('/generateROBS', function(data, textStatus, xhr) {
            $("#page_title").html("Generate ROBS");
            $("#ISA_content").html(data);
        });
    });




    $redirectTo = ("#"+$('#redirect').html()).replace(/\s/g, '');


    $(document).ready(function() {
      setTimeout(function() {
        $($redirectTo).trigger('click');
      }, 500);
    });