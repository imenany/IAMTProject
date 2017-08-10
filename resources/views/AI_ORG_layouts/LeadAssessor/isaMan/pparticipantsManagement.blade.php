<form id="pparticipantManagementForm">

  <div class="ui grid" >

  <div class="wide column">
  	  <table class="ui celled sortable striped fluid table" id="tablesort">
	    <thead>
	      <tr>
	        <th class="center aligned" rowspan="3" >@lang('strings.firstname')</th>
	        <th class="center aligned" rowspan="3">@lang('strings.lastname')</th>
	        <th class="center aligned" rowspan="3" >@lang('strings.fonction')</th>
	        <th class="center aligned" rowspan="3" >@lang('strings.organisation')</th>
	        <th class="center aligned" colspan="7">@lang('strings.role')</th>
	        <th class="center aligned" rowspan="3" >@lang('strings.delete')</th>
	      </tr>
	      <tr>
	        <th class="center aligned actif" colspan="4">ISA</th>
	        <th class="center aligned actif" colspan="3">Organisation</th>						      
	      </tr>
	      <tr>
	        <th class="center aligned">@lang('strings.assessor')</th>
	        <th class="center aligned">@lang('strings.projectManager')</th>
	        <th class="center aligned">@lang('strings.QA')</th>
	        <th class="center aligned">@lang('strings.approver')</th>
	        <th class="center aligned">@lang('strings.manager')</th>
	        <th class="center aligned">@lang('strings.projectparticipant')</th>
	        <th class="center aligned">@lang('strings.guest')</th>
	      </tr>
	    </thead>
	    <tbody>
	  	@foreach($project->pparticipants as $participant)
		      @if($participant->user->id == Auth::user()->id)
		      <tr class="hidden">
			  @else
				<tr>
			  @endif
		        <td class="iceBG"><b>{{$participant->user->first_name}}</b></td>
		        <td class="iceBG"><b>{{$participant->user->last_name}}</b></td>
		        <td>{{$participant->user->fonction}}</td>
		        <td>{{$participant->user->organisation}}</td>
		        @if($participant->user->organisation == "Viattech Q&S")

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
			  	<td colspan="3" class="active"></td>
			  	@else
			  	<td colspan="4" class="active"></td>
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
			  	@endif
			  	<td class="center aligned iceBG">
				  	<div class="ui radio checkbox hidden">
				  	<input tabindex="0" class="hidden" type="radio" value="delete" name="role[{{$participant->user->id}}]">
				    </div>
				    <i class="remove user red icon"></i>
			  	</td>
		      </tr>
	      @endforeach
	      
	    </tbody>
	    <tfoot>
	    	<tr>
	    		<td colspan="6" style="text-align:right">
					<select id="newintervenants">
			            @foreach($users as $p)
			            	@if($p->id != Auth::user()->id)
							<option value="{{$p->id}}" text="{{$p->first_name}} {{$p->last_name}}">{{$p->first_name}} {{$p->last_name}}</option>
							@endif
						@endforeach
					</select>
	    		</td>

	    		<td colspan="6">
					<div class="ui teal labeled icon button" id="addNew">
					    Add
					    <i class="add icon"></i>
				  	</div>
	    		</td>
	    			
	    	</tr>
	    </tfoot>
	  </table>
	  <div class="ui divider"></div>
	  <div class="ui grid">
	      <div class="ui twelve wide column"></div>
	      <div class="ui four wide column">
	      	<div class="ui fluid teal button Save" tabindex="0">
	                @lang('strings.save')
	        </div>
	      </div>
      </div>
	</div>
	</div>
	</form>


	<script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/semantic/semantic.min.js') }}"></script>
    <script src="{{ URL::asset('/js/pparticipantmanagement.js') }}"></script>
