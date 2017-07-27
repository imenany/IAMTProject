<div class="ui modal" id="settings_modal">
  <div class="header">Settings</div>
  <div class="content">
    Change language - Change profil settings - ....
  </div>
  <div class="actions">
    <div class="ui approve button">Apply Changes</div>
    <div class="ui cancel button">Cancel</div>
  </div>
</div>

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
  <div class="header">Edit project</div>
  <div class="content">
		<form class="ui form" method="post" id="edit_doc_form">
		<table class="ui definition table">
		<input name="document[id]" class="hidden">
		  <tbody>
		    <tr>
		      <td class="two wide column">Title</td>
		      <td><input name="document[title]" ></td>
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
		      <td> <input name="document[version]" ></td>
		    </tr>
		  </tbody>
		</table>
		<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
		<div class="ui grid segment">
			<div class="ui twelve wide column"></div>
			<div class="ui four wide column">
		        <button class="fluid yellow ui button" id="SubmitChanges">@lang('strings.save')</button>
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
		      <td class="two wide column">Description</td>
		      <td><textarea name="description" disabled=""></textarea></td>
		    </tr>
		    <tr>
		      <td class="two wide column">Recommendation</td>
		      <td><textarea name="recommendation" disabled></textarea></td>
		    </tr>
		    <tr>
		      <td class="two wide column">Response</td>
		      <td> <textarea name="response"></textarea></td>
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
		<input name="id" class="hidden">
		  <tbody>
		  	<tr>
		      <td class="two wide column">Response</td>
		      <td> <textarea name="responseA" disabled></textarea></td>
		    </tr>
		  	<tr>
		      <td class="two wide column">Description</td>
		      <td><textarea name="descriptionA"></textarea></td>
		    </tr>
		    <tr>
		      <td class="two wide column">Recommendation</td>
		      <td><textarea name="recommendationA"></textarea></td>
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