@extends('AI_layouts.adminContent')

@section('title', 'Users Management')

@section('body')

<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item">
          <h1>@lang('strings.usersMan')</h1> 
      </div>
    </div>
    <div id="doc_man_content">
    	
		<div class="ui grid" >
	<div class="wide column">
			<table class="ui selectable celled table datatable">
			  <thead>
			    <tr>
				    <th>@lang('strings.firstname')</th>
				    <th>@lang('strings.lastname')</th>
				    <th>@lang('strings.fonction')</th>
				    <th>@lang('strings.organisation')</th>
				    <th>@lang('strings.email')</th>
				    <th>@lang('strings.registredat')</th>
				    <th>@lang('strings.updatedat')</th>
				    <th>@lang('strings.edit')</th>
				    <th>@lang('strings.view')</th>
			  	</tr>
			  	</thead>
			  <tbody>
				@foreach($users as $user)
			    <tr>
					<td><strong>{{$user->first_name}}</strong></td>
					<td><strong>{{$user->last_name}}</strong></td>
					<td>{{$user->fonction}}</td>
					<td>{{$user->organisation}}</td>
					<td><strong>{{$user->email}}</strong></td>
					<td>{{$user->created_at}}</td>
					<td>{{$user->updated_at}}</td>
					<td class="selectable">
			        	<a href={{URL('/edituser/'.$user->id)}}><i class="edit sign icon yellow large"></i></a>
			      	</td>
			      	<td class="selectable">
			      		<a href={{URL('/viewuser/'.$user->id)}}><i class="address book icon yellow large"></i></a>
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

