@extends('main_layout')

@section('title', 'Uplad a file')

@section('doc_manager_content')


<div class="ui middle aligned center aligned grid">
  <div class="column">
  <h3>Upload your files </h3>
    <form class="ui large form" action="/uploadFile" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <div class="ui small action input" id="upload_input">
 		 		<input type="file" name="files[]" multiple>
  				<button class="ui button submit" type="submit"><i class="upload icon"></i> Upload</button>
			</div>
          </div>
        </div>
    </form>

    @if(!empty($ok))
          	@if($ok == "yes")
	          	<p><div class="ui green message notif_message" style="width: 50%; margin: 0 auto;">
				  		<i class="close icon"></i>
				  		<div class="header">Your file has been uploaded</div>
					</div></p>
			@else
				<p><div class="ui red message notif_message" style="width: 50%; margin: 0 auto;">
				  		<i class="close icon"></i>
				  		<div class="header">No file selected</div>
					</div></p>
          	@endif
          @endif
  </div>
</div>




    
@endsection