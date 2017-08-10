@extends('Admin_layouts.adminContent')

@section('title', 'Projects Management')

@section('body')

<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item">
          <h1>@lang('strings.projectMan')</h1> 
      </div>
    </div>
    <div id="admin_content">
    	
		<div class="ui grid" >
		<div class="wide column">
			<div class="ui" id="loading_files">
	  		<div class="ui active inverted dimmer">
	    		<div class="ui text loader">@lang('strings.loading')</div>
	  		</div>
	  		<p></p>
			</div>
			<table class="ui selectable celled table datatable">
			  <thead>
			    <tr>
				    <th>@lang('strings.title')</th>
				    <th>@lang('strings.description')</th>
				    <th>@lang('strings.organisation')</th>
				    <th>@lang('strings.startDate')</th>
				    <th>@lang('strings.endDate')</th>
				    <th>@lang('strings.projSTD')</th>
				    <th>@lang('strings.progress')</th>
				    <th>@lang('strings.corgbaseline')</th>
				    <th>@lang('strings.createdat')</th>
				    <th>@lang('strings.updatedat')</th>
				    <th>@lang('strings.action')</th>
			  	</tr>
			  	</thead>
			  <tbody>
				@foreach($projects as $project)
				    <tr>
						<td><strong>{{$project->title}}</strong></td>
						<td>{{$project->description}}</td>
						<td>{{$project->organisation}}</td>
						<td>{{$project->dateDebut}}</td>
						<td>{{$project->dateFin}}</td>
						<td>{{$project->STD}}</td>
						<td>{{$project->progress}}</td>
						<td>{{$project->c_orgBaseline}}</td>
						<td>{{$project->created_at}}</td>
						<td>{{$project->updated_at}}</td>
						<td class="selectable">
				        	<a href={{URL('/editproject/'.$project->id)}}><i class="edit sign icon orange large"></i></a>
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

@section('scripts')
    <script src="{{ URL::asset('/js/listproject.js') }}"></script>
@endsection
