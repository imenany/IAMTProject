@extends('AI_layouts.adminContent')

@section('title', 'Projects Management')

@section('body')

<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item">
          <h1>@lang('strings.projectMan')</h1> 
      </div>
    </div>
    <div id="doc_man_content">
    	
		<div class="ui grid" >
	<div class="wide column">
			<div class="ui" id="loading_files">
	  		<div class="ui active inverted dimmer">
	    		<div class="ui text loader">Loading</div>
	  		</div>
	  		<p></p>
			</div>
			<table class="ui selectable celled table datatable">
			  <thead>
			    <tr>
				    <th>Title</th>
				    <th>Description</th>
				    <th>Date Debut</th>
				    <th>Date Fin</th>
				    <th>STD</th>
				    <th>Progress</th>
				    <th>C_ORG Baseline</th>
				    <th>Created At</th>
				    <th>Updated At</th>
				    <th>Edit</th>
			  	</tr>
			  	</thead>
			  <tbody>
				@foreach($projects as $project)
				    <tr>
						<td><strong><a href="{{URL('/projects/'.$project->id)}}">{{$project->title}}</a></strong></td>
						<td>{{$project->description}}</td>
						<td>{{$project->dateDebut}}</td>
						<td>{{$project->dateFin}}</td>
						<td>{{$project->STD}}</td>
						<td>{{$project->progress}}</td>
						<td>{{$project->c_orgBaseline}}</td>
						<td>{{$project->created_at}}</td>
						<td>{{$project->updated_at}}</td>
						<td class="selectable">
				        	<a href={{URL('/editproject/'.$project->id)}}><i class="edit sign icon yellow large"></i></a>
				      	</td>
				    </tr>
				@endforeach
			  </tbody>
			</table>

	</div>

  	
</div>

    </div>
</div>

@endsection

