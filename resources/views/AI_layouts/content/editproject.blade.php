@extends('AI_layouts.adminContent')

@section('title', 'Projects Management')

@section('body')

<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item">
          <h1>@lang('strings.editProject') : </h1>
      </div>
      <div class="header item">
			<h3><i>{{$project->title}}</i></h3> 
      </div>
    </div>
    <div id="doc_man_content">
		<div class="ui grid" >
			<div class="sixteen wide column" style="border-radius: 0;">

				<form class="ui form" action="/editPorjectProperties" method="post">
				{{ csrf_field() }}

					<div class="ui three top attached steps">
					  <div class="active step" id="firsttabtitle">
					    <i class="info circle icon"></i>
					    <div class="content">
					      <div class="title">Project Information</div>
					      <div class="description">Introduce the project</div>
					    </div>
					  </div>
					  <div class="disabled step" id="secondtabtitle">
					    <i class="checkmark icon"></i>
					    <div class="content">
					      <div class="title">Standards</div>
					      <div class="description">Select project standards</div>
					    </div>
					  </div>
					  <div class="disabled step" id="thirdtabtitle">
					    <i class="users icon"></i>
					    <div class="content">
					      <div class="title">Intervenants</div>
					      <div class="description">Select project intervenant</div>
					    </div>
					  </div>
					</div>
						<div class="ui attached segment">
						<div class="" id="firsttab">
							<h2 class="ui dividing header">Project Information</h2>
						    <input name="Project[id]" hidden="" value="{{$project->id}}" id="projectid">
						    <div class="field">
						      <label>Title</label>
						      <div class="field">
						          <input name="Project[title]" placeholder="Title" type="text" value="{{$project->title}}">
						      </div>
						    </div>
						    <div class="field">
						      <label>Description</label>
						      <div class="field">
						        <div class="field">
						           <textarea rows="2" name="Project[description]">{{$project->description}}</textarea>
						        </div>
						      </div>
						    </div>
						    <div class="two fields">
						      <div class="field">
						        <label>Date début</label>
						        <div class="field">
						          <div class="ui calendar" id="dateStart">
						              <div class="ui input left icon">
						                <i class="calendar icon"></i>
						                <input name="Project[dateD]" placeholder="DD-MM-YYYY" type="text" value="{{$project->dateDebut}}">
						              </div>
						            </div>
						        </div>
						      </div>
						      <div class="field">
						        <label>Date fin</label>
						        <div class="field">
						            <div class="ui calendar" id="dateEnd">
						              <div class="ui input left icon">
						                <i class="calendar icon"></i>
						                <input name="Project[dateF]" placeholder="DD-MM-YYYY" type="text" value="{{$project->dateFin}}">
						              </div>
						            </div>
						        </div>
						      </div>
						    </div>
						    <div class="ui red message hidden" id="message">Please fill in all the inputs</div>
						    <div class="ui divider"></div>
						      <div class="field">
						        <div class="ui grid">
						          <div class="ui four wide column">
						          </div>
						          <div class="ui eight wide column"></div>
						          <div class="ui four wide column">
						            <div class="ui fluid button" tabindex="0" id="Next1">
						                Next
						              </div>
						          </div>
						        </div>
						      </div>
						</div>
						<div class="hidden" id="secondtab">
						  <h2 class="ui dividing header">Standards</h2>
						    <div class="field">
						      <div class="three fields">
						        @foreach($normes as $norme)
						        <div class="field">
						        <table class="ui celled table">
						          <thead>
						            <tr>
						              <th colspan="2">{{$norme->name}}</th>
						            </tr>
						          </thead>
						          <tbody>
						            @foreach($norme->normephases as $phase)
						            <tr>
						              <td class="fourteen wide"><label>{{$phase->name}}</label></td>
						              <td>
						                    @if(in_array($phase->id,$selectednormes))
										    	<div class="ui master checkbox checked">
										    @else <div class="ui master checkbox">
										    @endif
						                  	<input name="Phase[{{$phase->id}}]" type="checkbox">
						                </div>
						              </td>
						            </tr>
						            @endforeach
						          </tbody>
						          </table>
						          </div>
						        @endforeach
						      </div>
						    </div>
						  <div class="ui divider"></div>
						  <div class="field">
						    <div class="ui grid">
						      <div class="ui four wide column">
						          <div class="ui fluid button" tabindex="0" data-tabnumber="1" id="Previous1">
						            Previous
						          </div>
						      </div>
						      <div class="ui eight wide column"></div>
						      <div class="ui four wide column">
						        <div class="ui four wide column">
						          <div class="ui fluid button" tabindex="0" data-tabnumber="3" id="Next2">
						            Next
						          </div>
						      </div>
						      </div>
						    </div>
						  </div>
						</div>
						<div class="hidden" id="thirdtab">
							<h2 class="ui dividing header">Project Intervenants Information</h2>
						  <table class="ui celled sortable striped fluid table" id="tablesort">
						    <thead>
						      <tr>
						        <th class="center aligned" rowspan="2" >First Name</th>
						        <th class="center aligned" rowspan="2">Last Name</th>
						        <th class="center aligned" rowspan="2" >Fonction</th>
						        <th class="center aligned" rowspan="2" >Organisation</th>
						        <th class="center aligned" colspan="9">Role</th>
						        <th class="center aligned" rowspan="2" >Delete</th>
						      </tr>
						      <tr>
						        <th class="center aligned">Admin</th>
						        <th class="center aligned">Lead Assessor</th>
						        <th class="center aligned">Assessor</th>
						        <th class="center aligned">Project Manager</th>
						        <th class="center aligned">QA</th>
						        <th class="center aligned">Approver</th>
						        <th class="center aligned">Manager</th>
						        <th class="center aligned">Project Participant</th>
						        <th class="center aligned">Guest</th>
						      </tr>
						    </thead>
						    <tbody>
						  	@foreach($project->pparticipants as $participant)
						      <tr>
						        <td class="iceBG"><b>{{$participant->user->first_name}}</b></td>
						        <td class="iceBG"><b>{{$participant->user->last_name}}</b></td>
						        <td>{{$participant->user->fonction}}</td>
						        <td>{{$participant->user->organisation}}</td>
						        <td class="center aligned">
							       <div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Admin')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Admin"/>
							      </div>
							  	</td>
							  	<td class="center aligned">
							        <div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Lead Assessor')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Lead Assessor"/>	
							      </div>
							  	</td>
							  	<td class="center aligned">
							        <div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Assessor')) == 0 ? "checked": 'null' !!} tabindex="0" class="hidden" type="radio" value="Assessor"/>	
							      </div>
							  	</td>
							  	<td class="center aligned">
							  		<div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Project Manager')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Project Manager"/>
							            </div>
							  	</td>
							  	<td class="center aligned">
							  		<div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'QA')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="QA"/>
							            </div>
							  	</td>
							  	<td class="center aligned">
							      	<div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Approver')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Approver">
							            </div>
							  	</td>
							  	<td class="center aligned">
							      	<div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Manager')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Manager">
							            </div>
							  	</td>
							  	<td class="center aligned">
							      	<div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Project Participant')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Project Participant">
							            </div>
							  	</td>
							  	<td class="center aligned">
							      	<div class="ui radio checkbox">
							        <input name="role[{{$participant->user->id}}]" {!! (strcmp($participant->role->role,'Guest')) == 0 ? 'checked': 'null' !!} tabindex="0" class="hidden" type="radio" value="Guest">
							        </div>
							  	</td>
							  	<td class="center aligned iceBG">
								  	<div class="ui radio checkbox hidden">
								  	<input tabindex="0" class="hidden" type="radio" value="null" name="role[{{$participant->user->id}}]">
								    </div>
								    <i class="remove user red icon"></i>
							  	</td>
						      </tr>
						      @endforeach
						      
						    </tbody>
						    <tfoot>
						    	<tr>
						    		<th colspan="13" class="center aligned">
						    			<div class="ui teal labeled icon button" id="addNew">
									    Add New Intervenant	
									    <i class="add icon"></i>
									  </div>
						    		</th>
						    	</tr>
						    </tfoot>
						  </table>
						  <div class="ui divider"></div>
						  <div class="field">
						    <div class="ui grid">
						      <div class="ui four wide column">
						          <div class="ui fluid button" tabindex="0" id="Previous2">
						            Previous
						          </div>
						      </div>
						      <div class="ui eight wide column"></div>
						      <div class="ui four wide column">
						        <button class="fluid yellow ui button" type="submit">Save</button>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
				</form>

		    </div>
		</div>
	</div>


    @include('AI_layouts._modals_layout')
@endsection

@section('scripts')
    <script src="{{ URL::asset('/js/calendar.js') }}"></script>
    <script src="{{ URL::asset('/js/tablesort.js') }}"></script>
    <script src="{{ URL::asset('/js/editproject.js') }}"></script>
@endsection


@section('styles')
    <script src="{{ URL::asset('/css/calendar.css') }}"></script>
@endsection
