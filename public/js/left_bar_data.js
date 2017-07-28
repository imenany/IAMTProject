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

/*	$.ajax({
		url: '/getdocsnotifications',
		type: 'POST',
		cash: 'false',
		success: function (data) {
			$('#notif_docs').html(data);
			if(data > 0)
				$('#notif_docs').addClass('yellow');
			else $('#notif_docs').removeClass('yellow');

		}
	})
*/
/*window.setInterval(function(){

	$.ajax({
		url: '/listProjectsRequest',
		type: 'GET',
		cash: 'false',
		success: function (data) {
			var $projects = $('#leftbar_projects');
			$projects.html("");
			$.each(data,function(index, project) {
				$item = '<a class="item active" href="/projects/'+project.project.id+'">'+project.project.title+'</a>';
				$projects.append($item);
			});
		}
	})

	$.ajax({
		url: '/getdocsnotifications',
		type: 'POST',
		cash: 'false',
		success: function (data) {
			$('#notif_docs').html(data);
			if(data > 0)
				$('#notif_docs').addClass('yellow');
			else $('#notif_docs').removeClass('yellow');
		}
	})

}, 5000);

*/


/***************************** Chat Elements ***************************/
var interval = null;



	$cl_comment = '<div class="comment">';
	$cl_content = '<div class="content">';
	$a_author = '<a class="author">';
	$cl_date='<div class="metadata"><span class="date">';
	$close_span='</span>';
	$cl_text = '<div class="text">';
	$cl_actions = '<div class="actions"><a class="reply" >Reply</a>';

/*	window.setInterval(function(){
		$.ajax({
			url: '/listProjectMessages',
			type: 'GET',
			cash: 'false',
			success: function (data) {
				var $messages = $('#messages');
				var $old_messages = $('#messages').html();
				$messages.html("");
				$.each(data,function(index, message) {
					$item = $cl_comment + $cl_content + $a_author + message.user.first_name +' '+message.user.last_name + '</a>' + $cl_date + message.created_at + $close_span + '</div>' + $cl_text + message.message + '</div>' + $cl_actions + '</div>' + '</div>' + '</div>';
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
	}, 5000);*/


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
