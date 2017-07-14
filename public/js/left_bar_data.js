$.ajax({
	url: '/listProjectsRequest',
	type: 'GET',
	cash: 'false',
	success: function (data) {
		var $path = window.location.pathname;
		var $project_id = $path.substring($path.lastIndexOf("/") + 1, $path.length);
		var $projects = $('#leftbar_projects');
		$retour = $.parseJSON(data);
		$.each($retour,function(index, project) {
			if($project_id == project.id)
				$item = '<a class="item active" href="/projects/'+project.id+'">'+project.title+'</a>';
			else $item = '<a class="item" href="/projects/'+project.id+'">'+project.title+'</a>';
			$projects.append($item);
		});
	}
})
.done(function() {
	//console.log("success");
})
.fail(function() {
	//console.log("error");
})
.always(function() {
	//console.log("complete");
});