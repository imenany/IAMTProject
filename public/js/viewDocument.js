var evaluations;

$.ajax({
    url: '/getEvaluationStates',
    type: 'GET',
    success : function(data){
        evaluations = data;
    }
})
.done(function() {
    console.log(evaluations);
})
.fail(function() {
    console.log("error");
})
.always(function() {
    console.log("complete");
});



$('.show_file').click(function(event) {
        $url = $(this).data("url").replace("public/","");
        $id = $(this).data("id");
        $status = $(this).data("status");

        if($url.includes('.jpg') || $url.includes('.png') || $url.includes('.jpeg') || $url.includes('.bmp') || $url.includes('.csv') || $url.includes('.svg'))
        {
            $('#files_reader').html('<img src="/storage/'+$url+'" alt="placeholder+image" id="image" data-zoom-image="storage/Desert.jpg">');
        }
        else if($url.includes('.pdf')){
            $('#files_reader').html('<object data="/storage/'+$url+'" type="application/pdf" width="100%" height="100%"><p>Alternative text - include a link <a href="/storage/download/pdffile.pdf">to the PDF!</a></p></object>');
        }
        else {
            $('#files_reader').html('<h4 class="class="header">This document is only available for download</h4><a href="/storage/'+$url+'"><div class="ui button labeled icon large linkedin" tabindex="0"><i class="download icon"></i> Download</div></a>');
        }
        $last = $url.substring($url.lastIndexOf("/") + 1, $url.length);
        $title = $last + "<a download="+$last+" href='/storage/"+$url+"'><i class='download icon'></i></a>";
        $('#document_title').html($title);

        $html = '';
        for (var i = evaluations.length - 1; i >= 0; i--) {
            if($status == evaluations[i].id)
                $html+= "<option value='"+evaluations[i].id+"' selected='true'>"+evaluations[i].state+"</option>";
            else
                $html+= "<option value='"+evaluations[i].id+"'>"+evaluations[i].state+"</option>";
        }

        $('#readStatuts').html("Select evaluation state : <select data-id="+$id+" id='status' class='ui fluid dropdown'>"+$html+"</select>");
        $('#loading_preview').show();

        setTimeout(function() {
            $('#loading_preview').fadeOut('fast');
          }, 650); 
   });

$('#readStatuts').on('change', '#status', function(event) {
    event.preventDefault();
    $Document_id = $(this).data('id');
    $Status_id = $(this).val();

    $.ajax({
        url: '/changeStatus',
        type: 'POST',
        data: {
            'document': $Document_id ,
            'stat': $Status_id
        },
    })
    .done(function() {
        alert('Status Changed');
        $("a[data-id='"+$Document_id+"']").data('status',$Status_id);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
});




function getAllElementsWithAttribute(attribute)
{
  var matchingElements = [];
  var allElements = document.getElementsByTagName('*');
  for (var i = 0, n = allElements.length; i < n; i++)
  {
    if (allElements[i].getAttribute(attribute) !== null)
    {
      // Element exists with attribute. Add to array.
      matchingElements.push(allElements[i]);
    }
  }
  return matchingElements;
}