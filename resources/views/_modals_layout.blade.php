<div class="ui modal" id="new_baseline_modal">
	  <div class="header">Alert - new Baseline</div>
	  <div class="content">
		<p>The current baseline will be locked if you create a new one, do you agree?</p>

	  </div>
	  <div class="actions">
	    <div class="ui approve button" id="lock_baseline">Yes</div>
	    <div class="ui cancel button">No</div>
	  </div>
</div>


<div class="ui modal" id="EditDocument">
	{{ csrf_field() }}
  <i class="close icon"></i>
  <div class="header">Edit document</div>
  <div class="content">
		<form class="ui form" method="post" id="edit_doc_form" enctype="multipart/form-data">
		<table class="ui definition table">
		<input name="document[id]" class="hidden">
		  <tbody>
		    <tr>
		      <td class="two wide column">Title</td>
		      <td><input name="document[title]" ></td>
		    </tr>
		    <tr>
		      <td class="two wide column">File</td>
		      <td> <input type="file" name="document[file]" /></td>
		    </tr>
		    <tr>
		      <td class="two wide column">Phase</td>
		      <td>
				<div class="ui fluid search selection dropdown">
					<input name="document[phase]" type="hidden" id="organisation_name" value="">
		            <i class="dropdown icon"></i>
		            <div class="default text"></div>

					<div class="menu" id="menu_normes">

		            </div>
		         </div>
		      </td>
		    </tr>
		    <tr>
		      <td class="two wide column">Version</td>
		      <td> <input name="document[version]" type='number' step="0.1"></td>
		    </tr>
		  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		<div class="ui grid segment">
			<div class="ui twelve wide column"></div>
			<div class="ui four wide column">
		        <button class="fluid yellow ui button" id="SubmitEditDocument">@lang('strings.save')</button>
		    </div>
	    </div>
		</form>
	</div>
</div>


<div class="ui modal" id="addResponseModal">
	{{ csrf_field() }}
  <i class="close icon"></i>
  <div class="header" id="finding_name">Add response to finding : </div>
  <div class="content">
		<form class="ui form" id="response_finding_form">
				<table class="ui definition table">
			<input name="id" class="hidden">
			  <tbody>
			  	<tr>
	              <td class="two wide column">@lang('strings.finding')</td>
	              <td><input name="finding[finding]" disabled></td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.relatedDoc')</td>
	              <td>
	                 <div class="ui form">
	                  <div class="field">
	                      <select name="finding[document]" disabled>
	                        
	                          {{--<option value="{{$document->id}}">{{$document->title}} </option>--}}
	                        
	                      </select>
	                  </div>
	                </div>
	              </td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.description')</td>
	              <td><textarea name="finding[description]" disabled=""></textarea></td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.recommendation')</td>
	              <td><textarea name="finding[recommendation]" disabled></textarea></td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.response')</td>
	              <td><textarea name="finding[response]"></textarea></td>
	            </tr>
	            <tr>
	              <td>@lang('strings.severity')</td>
	              <td>
	                <div class="ui form">
	                  <div class="field" >
	                      <select name="finding[severity]" disabled>
	                        <option value="NA">NA</option>
	                        <option value="MIN">MIN</option>
	                        <option value="MAJ">MAJ</option>
	                        <option value="CRIT">CRIT</option>
	                      </select>
	                  </div>
	                </div>
	              </td>
	            </tr>

	            <tr>
	              <td class="two wide column">@lang('strings.responsable')</td>
	              <td>
	                <div class="ui form">
	                  <div class="field">
	                      <select name="finding[responsable]" disabled>

	                          {{--<option value="{{$user->user->id}}">{{$user->user->first_name}} {{$user->user->last_name}}</option>--}}

	                      </select>
	                  </div>
	                </div>
	              </td>
	            </tr>
			  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		<div class="ui grid segment">
			<div class="ui twelve wide column"></div>
			<div class="ui four wide column">
		        <div class="fluid yellow ui button save" id="SubmitResponse">@lang('strings.save')</div>
		    </div>
	    </div>
		</form>
	</div>
</div>


<div class="ui modal" id="addResponseAModal">
	{{ csrf_field() }}
  <i class="close icon"></i>
  <div class="header" id="finding_nameA">Add description to finding : </div>
  <div class="content">
		<form class="ui form" id="responseA_finding_form">
		<table class="ui definition table">
			<input name="idA" class="hidden">
			  <tbody>
			  	<tr>
	              <td class="two wide column">@lang('strings.finding')</td>
	              <td><input name="finding[findingA]" disabled="" ></td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.relatedDoc')</td>
	              <td>
	                 <div class="ui form">
	                  <div class="field">
	                      <select name="finding[documentA]" disabled="">
	                        
	                          {{--<option value="{{$document->id}}">{{$document->title}} </option>--}}
	                        
	                      </select>
	                  </div>
	                </div>
	              </td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.description')</td>
	              <td><textarea name="finding[descriptionA]" ></textarea></td>
	            </tr>
	            <tr>
	              <td class="two wide column">@lang('strings.recommendation')</td>
	              <td><textarea name="finding[recommendationA]"></textarea></td>
	            </tr>
	            <tr>
	              <td>@lang('strings.severity')</td>
	              <td>
	                <div class="ui form">
	                  <div class="field">
	                      <select name="finding[severityA]">
	                        <option value="NA">NA</option>
	                        <option value="MIN">MIN</option>
	                        <option value="MAJ">MAJ</option>
	                        <option value="CRIT">CRIT</option>
	                      </select>
	                  </div>
	                </div>
	              </td>
	            </tr>

	            <tr>
	              <td class="two wide column">@lang('strings.responsable')</td>
	              <td>
	                <div class="ui form">
	                  <div class="field">
	                      <select name="finding[responsableA]">

	                          {{--<option value="{{$user->user->id}}">{{$user->user->first_name}} {{$user->user->last_name}}</option>--}}

	                      </select>
	                  </div>
	                </div>
	              </td>
	            </tr>
			  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		<div class="ui grid segment">
			<div class="ui twelve wide column"></div>
			<div class="ui four wide column">
		        <div class="fluid yellow ui button save" id="SubmitResponseA">@lang('strings.save')</div>
		    </div>
	    </div>
		</form>
	</div>
</div>


<div class="ui modal" id="editFindingModal">
	{{ csrf_field() }}
  <i class="close icon"></i>
  <div class="header" id="finding_nameA">Modify finding : </div>
  <div class="content">
		<form class="ui form" id="modify_finding_form">
		<table class="ui definition table">
		<input name="theid" class="hidden">
		  <tbody>
		  	<tr>
              <td class="two wide column">@lang('strings.finding')</td>
              <td><input name="finding[newfinding]" ></td>
            </tr>
            <tr>
              <td class="two wide column">@lang('strings.relatedDoc')</td>
              <td>
                 <div class="ui form">
                  <div class="field">
                      <select name="finding[newdocument]">
                        
                          {{--<option value="{{$document->id}}">{{$document->title}} </option>--}}
                        
                      </select>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="two wide column">@lang('strings.description')</td>
              <td><textarea name="finding[newdescription]"></textarea></td>
            </tr>
            <tr>
              <td class="two wide column">@lang('strings.recommendation')</td>
              <td><textarea name="finding[newrecommendation]"></textarea></td>
            </tr>
            <tr>
              <td>@lang('strings.severity')</td>
              <td>
                <div class="ui form">
                  <div class="field">
                      <select name="finding[newseverity]">
                        <option value="NA">NA</option>
                        <option value="MIN">MIN</option>
                        <option value="MAJ">MAJ</option>
                        <option value="CRIT">CRIT</option>
                      </select>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td class="two wide column">@lang('strings.responsable')</td>
              <td>
                <div class="ui form">
                  <div class="field">
                      <select name="finding[newresponsable]">

                          {{--<option value="{{$user->user->id}}">{{$user->user->first_name}} {{$user->user->last_name}}</option>--}}

                      </select>
                  </div>
                </div>
              </td>
            </tr>
		  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		<div class="ui grid segment">
			<div class="ui twelve wide column"></div>
			<div class="ui four wide column">
		        <div class="fluid yellow ui button save" id="submitModification">@lang('strings.save')</div>
		    </div>
	    </div>
		</form>
	</div>
</div>

<div class="ui modal" id="addRobsCommentModal">
	{{ csrf_field() }}
  <i class="close icon"></i>
  <div class="header" id="finding_nameA">Add comment </div>
  <div class="content">
		<form class="ui form" id="comment_ROBS_form">
		<table class="ui definition table">
		<input name="userid" class="hidden">
		<input name="robsid" class="hidden">
		  <tbody>
            <tr>
              <td class="two wide column">@lang('strings.comment')</td>
              <td><textarea name="comment"></textarea></td>
            </tr>
		  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		<div class="ui grid segment">
			<div class="ui twelve wide column"></div>
			<div class="ui four wide column">
		        <div class="fluid yellow ui button save" id="addFindingComment">@lang('strings.save')</div>
		    </div>
	    </div>
		</form>
	</div>
</div>

<div class="ui modal" id="showRobsCommentsModal">
	{{ csrf_field() }}
  <i class="close icon"></i>
  <div class="header" id="finding_nameA">Show Comments</div>
  <div class="content">
		<form class="ui form" id="comment_ROBS">
		<table class="ui definition table">
		<input name="userid" class="hidden">
		<input name="robsid" class="hidden">
		  <tbody id="robscommentsbody">
            
		  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		</form>
	</div>
</div>

