@extends('AI_layouts.adminContent')

@section('title', 'Edit user')

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
				<div class="ui hidden" id="Saving">
			  		<div class="ui active inverted dimmer">
			    		<div class="ui large text loader"><i class="save icon"></i>@lang('strings.Saving')</div>
			  		</div>
		  			<p></p>
				</div>
				<div class="ui  segment">
				<h4 class="ui horizontal divider header">
				  <i class="user icon"></i>
				  @lang('strings.userinfotitle')
				</h4>
				<form class="ui form" method="post" id="form">
				<table class="ui definition table">
				<input name="user[id]" class="hidden" value="{{$user->id}}">
				  <tbody>
				    <tr>
				      <td class="two wide column">@lang('strings.firstname')</td>
				      <td><input name="user[firstname]" value="{{$user->first_name}}"></td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.lastname')</td>
				      <td> <input name="user[lastname]" value="{{$user->last_name}}"></td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.email')</td>
				      <td> <input name="user[email]" value="{{$user->email}}"></td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.fonction')</td>
				      <td> <input name="user[fonction]" value="{{$user->fonction}}"></td>
				    </tr>
				    <tr>
				      <td class="two wide column">@lang('strings.organisation')</td>
				      <td> <input name="user[organisation]" value="{{$user->organisation}}"></td>
				    </tr>
				  </tbody>
				</table>
				<div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
				</div>
				<div class="ui grid segment">
					<div class="ui twelve wide column"></div>
					<div class="ui four wide column">
				        <button class="fluid yellow ui button" id="SubmitChanges">@lang('strings.save')</button>
				    </div>
			    </div>
				</form>
			</div>
			</div>
		</div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('/js/edituser.js') }}"></script>
@endsection