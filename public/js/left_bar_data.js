$projID = $('input[name="projID"]').val();

$.ajax({
	url: '/listProjectsRequest',
	type: 'GET',
	cash: 'false',
	success: function (data) {
		var $projects = $('#leftbar_projects');
		$projects.html("");
		$.each(data,function(index, project) {
			if(project.project.id == $projID)
				$item = '<a class="item active selectedProj" href="/projects/'+project.project.id+'"><h4>'+project.project.title+'</h4></a>';
			else $item = '<a class="item" href="/projects/'+project.project.id+'">'+project.project.title+'</a>';
			$projects.append($item);
		});
	}
});

$('#documentsNotifications')
  .popup({
  	on    : 'click',
    popup: $('#documentsNotificationsPopUp'),
	inline     : true,
    hoverable  : true,
    position   : 'right center',
    lastResort : 'right center',
    delay: {
      show: 300,
      hide: 800
    }
  })
;


$('#findingsNotifications')
  .popup({
  	on    : 'click',
    popup: $('#findingsNotificationsPopUp'),
	inline     : true,
    hoverable  : true,
    position   : 'right center',
    lastResort : 'right center',
    delay: {
      show: 300,
      hide: 800
    }
  })
;


$('#reviewsNotifications')
  .popup({
  	on    : 'click',
    popup: $('#reviewsNotificationsPopUp'),
	inline     : true,
    hoverable  : true,
    position   : 'right center',
    lastResort : 'right center',
    delay: {
      show: 300,
      hide: 800
    }
  })
;

/***************************** Chat Elements ***************************/
var interval = null;


	$cl_content = '<div class="content">';
	$close_span='</span>';

window.setTimeout(function(){

		/************************* Notifications *********************/
		$.ajax({
			url: '/getreviewingnotifications',
			type: 'POST',
			cash: 'false',
			success: function (data) {
				$('#notif_review').html(data.length)
				if(data.length > 0)
				{
					$('#notif_review').addClass('blue');
					$element = '';
					for (var i = data.length - 1; i >= 0; i--) {
						$element+='<a class="viewReviewsNotif" data-not="'+data[i].id+'"><div class="content">'+data[i].notification+'</div></a><div class="ui fitted divider"></div>';
					}

					$('#reviewsNotificationsPopUp').html($element);
				}
				else $('#notif_review').removeClass('blue');
			}
		});

		$.ajax({
			url: '/getdocumentsnotifications',
			type: 'POST',
			cash: 'false',
			success: function (data) {
				$('#notif_docs').html(data.length)
				if(data.length > 0)
					{
						$('#notif_docs').addClass('blue');
						$element = "";

					for (var i = data.length - 1; i >= 0; i--) {
							$element+='<a class="viewDocsNotif" data-not="'+data[i].id+'"><div class="content">'+data[i].notification+'</div></a><div class="ui fitted divider"></div>';
						}

						$('#documentsNotificationsPopUp').html($element);
					}
				else $('#notif_docs').removeClass('blue');
			}
		});

		$.ajax({
			url: '/getfindingsnotifications',
			type: 'POST',
			cash: 'false',
			success: function (data) {
				$('#notif_findings').html(data.length)
				if(data.length > 0)
				{
					$('#notif_findings').addClass('blue');
					$element = "";
					for (var i = data.length - 1; i >= 0; i--) {
						$element+='<a class="viewFindingsNotif" data-not="'+data[i].id+'"><div class="content">'+data[i].notification+'</div></a><div class="ui fitted divider"></div>';
					}

					$('#findingsNotificationsPopUp').html($element);
				}
				else $('#notif_findings').removeClass('blue');

			}
		});
}, 5000);


//window.setInterval(function(){

		/************************** Chat *****************************/
		$.ajax({
			url: '/listProjectMessages',
			type: 'GET',
			cash: 'false',
			success: function (data) {
				var $messages = $('#messages');
				var $old_messages = $('#messages').html();
				$messages.html("");
				$.each(data,function(index, message) {
					if(message.user.id == $('#authuserid').html())
					{
						$cl_comment = '<div class="comment_auth">';
						$cl_text = '<div class="text_auth">';
						$a_author = '<span class="author_auth">';
						$cl_date='<div><div class="metadata_auth"><span class="date">';
						$item = $cl_comment + $cl_content + $cl_text + message.message + '</div>' + $cl_date + message.created_at +'-'+ $a_author + message.user.first_name +' '+message.user.last_name + $close_span + '</span></div>' + '</div>' + '</div>' + '</div>';

					}
					else {
						$cl_comment = '<div class="comment_others">';
						$cl_text = '<div class="text_others">';
						$a_author = '<span class="author_others">';
						$cl_date='<div><div class="metadata_others"><span class="date">';
						$item = $cl_comment + $cl_content + $cl_text + message.message + '</div>' + $cl_date +  message.created_at +'-'+ $a_author + message.user.first_name +' '+message.user.last_name + $close_span + '</span></div>' + '</div>' + '</div>' + '</div>';
					}
					$messages.append($item);
				});

				if($old_messages != $messages.html())
				{
					interval = setInterval(pulse, 500);
				}
			}
		}).done(function() {
		    $('#chat_title').click(function(event) {
		    	clearInterval(interval);
		        $('#chat_content').toggle();
		        $('#chat_text').toggle();
		        $("#messages").animate({ scrollTop: $("#messages").height()*10000 }, "slow");
		    });
			$('.reply').click(function(event) {
				$('#Message').val("@"+$(this).parent().siblings('.author').html()+' '+$(this).parent().siblings('.metadata').children('.date').html() + "\n >>>> \n");
			});
		});


		/*********************************************************/

//}, 5000);


	$('#addMessage').click(function(event) {
		$message = $('#Message').val();
		$.ajax({
			url: '/addMessage',
			type: 'GET',
			data: {'message': $message},
			success: function (data) {
				$('#addMessage').parent().parent().children('.thirteen').children('textarea').val("");
			}
		}).done(function() {
			clearInterval(interval);
		});
	});



function pulse() {
    $('#chat_title').fadeTo( "fast", 0.7 );
    $('#chat_title').fadeTo( "fast", 1 );
}

$('#documentsNotificationsPopUp').on('click', '.viewDocsNotif', function(event) {
	$id = $(this).data('not');
	$.ajax({
		url: '/setNotifcationSeen',
		type: 'POST',
		data: {'id': $id}
	})
	.done(function() {
		console.log("success");
	})
	
	$('#showallDocuments').click();
});

$('#findingsNotificationsPopUp').on('click', '.viewFindingsNotif', function(event) {
	$id = $(this).data('not');
	$.ajax({
		url: '/setNotifcationSeen',
		type: 'POST',
		data: {'id': $id}
	})
	.done(function() {
		console.log("success");
	})
	
	$('#showAllFindings').click();
});

$('#reviewsNotificationsPopUp').on('click', '.viewReviewsNotif', function(event) {
	$id = $(this).data('not');
	$.ajax({
		url: '/setNotifcationSeen',
		type: 'POST',
		data: {'id': $id}
	})
	.done(function() {
		console.log("success");
	})
	
	$('#showQualityReview').click();
});