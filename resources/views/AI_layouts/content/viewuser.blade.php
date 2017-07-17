@extends('AI_layouts.adminContent')

@section('title', 'View user')

@section('body')

<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item">
          <h1>@lang('strings.userInfoTitle')</h1> 
      </div>
    </div>
    <div id="doc_man_content">
		<div class="ui grid" >
			<div class="wide column">
				<div class="ui  segment">
				<h4 class="ui horizontal divider header">
				  <i class="user icon"></i>
				  @lang('strings.userinfotitle')
				</h4>
				
				<table class="ui definition table">
				  <tbody>
				    <tr>
				      <td class="two wide column">@lang('strings.firstname')</td>
				      <td>{{$user->first_name}}</td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.lastname')</td>
				      <td>{{$user->last_name}}</td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.email')</td>
				      <td>{{$user->email}}</td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.fonction')</td>
				      <td>{{$user->fonction}}</td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.organisation')</td>
				      <td>{{$user->organisation}}</td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.registredat')</td>
				      <td>{{$user->created_at}}</td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.updatedat')</td>
				      <td>{{$user->updated_at}}</td>
				    </tr>
				  </tbody>
				</table>
				</div>
				<div class="ui  segment">
				<h4 class="ui horizontal divider header">
				  <i class="cubes icon"></i>
				  @lang('strings.currentProj')
				</h4>
				<table class="ui selectable celled table datatable">
					<thead>
						<tr>
							<th>@lang('strings.project')</th>
							<th>@lang('strings.description')</th>
							<th>@lang('strings.startDate')</th>
							<th>@lang('strings.endDate')</th>
							<th>@lang('strings.role')</th>
						</tr>
					</thead>
					  <tbody>
					  @foreach($user->pparticipants as $pp)
							
					   @if(strtotime($pp->project->dateFin) >= strtotime(date('Y-m-d')))
					    <tr>
					      <td>{{$pp->project->title}}</td>
					      <td class="ten wide column">{{$pp->project->description}}</td>
					      <td class="one wide column">{{$pp->project->dateDebut}}</td>
					      <td class="one wide column">{{$pp->project->dateFin}}</td>
					      <td class="two wide column">{{$pp->role->role}}</td>
					    </tr>
					    @endif
					  @endforeach
					  </tbody>
				</table>
				</div>
				<div class="ui segment">
				<h4 class="ui horizontal divider header">
				  <i class="history icon"></i>
				  @lang('strings.historyProj')
				</h4>
				<table class="ui selectable celled table datatable">
					<thead>
						<tr>
							<th>@lang('strings.project')</th>
							<th>@lang('strings.description')</th>
							<th>@lang('strings.startDate')</th>
							<th>@lang('strings.endDate')</th>
							<th>@lang('strings.role')</th>
						</tr>
					</thead>
					  <tbody>
					  @foreach($user->pparticipants as $pp)
							
					   @if(strtotime($pp->project->dateFin) < strtotime(date('Y-m-d')))
					    <tr>
					      <td>{{$pp->project->title}}</td>
					      <td class="ten wide column">{{$pp->project->description}}</td>
					      <td class="one wide column">{{$pp->project->dateDebut}}</td>
					      <td class="one wide column">{{$pp->project->dateFin}}</td>
					      <td class="two wide column">{{$pp->role->role}}</td>
					    </tr>
					    @endif
					  @endforeach
					  </tbody>
				</table>
				</div>
			</div>
			</div>
		</div>
    </div>
</div>

@endsection

