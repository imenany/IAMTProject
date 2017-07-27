<div class="ui modal" id="EditDocument">
  <div class="header">@lang('strings.editproject')</div>
	<form class="ui form" method="post" id="form" action='/saveEditionDoc'>
	{{ csrf_field() }}
	<table class="ui definition table">
	<input name="document[id]" class="hidden" value="{{$document->id}}">
	  <tbody>
	    <tr>
	      <td class="two wide column">@lang('strings.title')</td>
	      <td><input name="document[title]" value="{{pathinfo($document->title, PATHINFO_FILENAME)}}"></td>
	    </tr>
	    <tr>
	      <td class="two wide column">@lang('strings.phase')</td>
	      <td>
			<div class="ui fluid search selection dropdown">
			@if(!empty($document->phase))
	            <input name="document[phase]" type="hidden" id="organisation_name" value="{{$document->normesphase->name}}">
	            <i class="dropdown icon"></i>
	            <div class="default text">{{$document->normesphase->name}}</div>
	        @else 
	        	<input name="document[phase]" type="hidden" id="organisation_name" value="">
	            <i class="dropdown icon"></i>
	            <div class="default text"></div>
            @endif
	            <div class="menu">
					@foreach($normes as $normephase)
						<div class="item" name="document[phase]" data-value="{{$normephase->normesphase->id}}" data-text="{{$normephase->normesphase->name}}">
			                {{$normephase->normesphase->name}}
				        </div>
					@endforeach
	            </div>
	         </div>
	      </td>
	    </tr>
	    <tr>
	      <td class="two wide column">@lang('strings.version')</td>
	      <td> <input name="document[version]" value="{{$document->version}}"></td>
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
    

<script src="{{ URL::asset('/js/custom.js') }}"></script>
