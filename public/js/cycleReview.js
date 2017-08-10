$("#cycleReviewTable").on('click', '.validateApprover', function(event) {
	$id = $(this).data('doc');
	$user = $(this).data('user');
	$unvalidate = '<i class="remove large red icon link unValidateApprover" data-doc="'+$id+'" data-user="'+$user+'"></i>';
	$validate = $(this);
	if (confirm('Are you sure you want to approve this ROBS version? ')) {
		$.ajax({
			url: '/validateROBS',
			type: 'POST',
			data: {
				"id" : $id ,
				"user" : $user
			},
			success: function (data) {
				alert('This ROBS version has been validated');
	    	}
		}).done(function() {
			$validate.parent().html($unvalidate);
		});
	}
});


$("#cycleReviewTable").on('click', '.unValidateApprover', function(event) {
	$id = $(this).data('doc');
	$user = $(this).data('user');
	$unvalidate = $(this);

	$validate = '<i class="checkmark box large green icon link validateApprover" data-doc="'+$id+'" data-user="'+$user+'"></i>';
	if (confirm('Are you sure you want to reject this ROBS version? ')) {
		$.ajax({
			url: '/unValidateROBS',
			type: 'POST',
			data: {
				"id" : $id ,
				"user" : $user
			},
			success: function (data) {
				alert('This ROBS version has been unvalidated');
	    	}
		}).done(function() {
			$unvalidate.parent().html($validate);
		});
	}
});



$("#cycleReviewTable").on('click', '.editRobsFindings', function(event) {
	$.post('/modifyFinding', function(data, textStatus, xhr) {
        $("#page_title").html("Modify a finding");
        $("#ISA_content").html(data);
    });
});


$("#cycleReviewTable").on('click', '.addFindingComment', function(event) {
	$id = $(this).data('doc');
	$user = $(this).data('user');
	$("textarea[name='comment']").val('');
    $('#addRobsCommentModal').modal({
        selector : {
                    close    : '.close, .actions .button',
                    approve  : '.save',
                    deny     : '.actions .negative, .actions .deny, .actions .cancel'
                  },
        onShow : function() {
                    $.ajax({
                      url: '/getLastComment',
                      data: {'robsid': $id , 'userid': $user},
                      type: 'GET',
                      success: function (data) {
                      	if(data != "null")
                          $("textarea[name='comment']").val(data.commentaire);
                    	  $("input[name='userid']").val($user);
                          $("input[name='robsid']").val($id);
                        
                        }

                    })
                  },
        onApprove : function() {
        			if (confirm('Are you sure you want to save this comment? ')) {
                      $.ajax({
                        url: '/saveROBSComment',
                        type: 'POST',
                        data: $('#comment_ROBS_form').serialize()
                      }).done(function() {
                          alert('Your comment has been added');
                      });
                  	}
                  }
    }).modal('show');
});

$("#cycleReviewTable").on('click', '.showROBSComments', function(event) {
	$id = $(this).data('doc');
	$("textarea[name='QA_Comment']").val('');
	$("textarea[name='Approver_Comment']").val('');

	var bool = true;

	$.ajax({
      url: '/getROBSComments',
      data: {'robsid': $id },
      type: 'GET',
      success: function (data) {
      	if(data[0])
      		$('#robscommentsbody').append('<tr><td class="two wide column">'+data[0].user.last_name +' '+data[0].user.first_name+'</td><td><textarea disabled="true">'+data[0].commentaire+'</textarea></td></tr>');
      	else bool = false;
      	if(data[1])
      		$('#robscommentsbody').append('<tr><td class="two wide column">'+data[1].user.last_name +' '+data[1].user.first_name+'</td><td><textarea disabled="true">'+data[1].commentaire+'</textarea></td></tr>');        	
        }
    }).done(function() {
	    if(bool == true)
		    $('#showRobsCommentsModal').modal({
		        selector : {
		                    close    : '.close, .actions .button',
		                    approve  : '.save',
		                    deny     : '.actions .negative, .actions .deny, .actions .cancel'
		                  },
		        onHidden : function() {
		                      	$('#robscommentsbody').html('');
		                  }
		    }).modal('show');
		else alert("There's no comment for this ROBS version");
	});

	

});