<div class="ui grid">
	<div class="one wide column">
	</div>
	<div class="fourteen wide column">
		@if($exists != 'false')
			@if($exists->status == "locked" || $exists->status == "opened")
				<form class="ui large form" action="/updateBaseline" method="post" enctype="multipart/form-data" id="updateBaseline" data-exists="{{$exists->status}}">
				    {{csrf_field()}}
						<table class="ui celled structured table" class="new_baseline_table" style="text-align: center;">
					  <thead>
					    <tr>
					      <th colspan="4">@lang('strings.uploadBaselineDocs')</th>
					    </tr>
					    <tr>
					      <th>@lang('strings.oldDocument')</th>
					      <th>Current @lang('strings.version')</th>
					      <th>@lang('strings.newDocument')</th>
					      <th>New @lang('strings.version')</th>
					    </tr>
					  </thead>
					  <tbody>
						  @foreach($exists->documents as $key => $doc)
						  	@if($doc->valid == 1)
						    <tr id="AllDocuments">
						      <td>
								<div class="ui stacked">
								<div class="field">
								  <div class="ui left icon input">
								    <div class="ui action input">
									 		<input type="text" value="{{$doc->title}}" />	
									 		<input type="text" name="field[{{$key}}][oldFile]" value="{{$doc->id}}" hidden="true" />	
									</div>
								  </div>
								</div>
						      </td>
						      <td width="100">
						      	<div class="field">
						      		<input name="field[{{$key}}][version]" type="number" min="{{$doc->version}}" value="{{$doc->version }}" step="0.1" disabled="">
						      	</div>
						      </td>
						      <td>
						      	<div class="ui stacked ">
								<div class="field">
								  <div class="ui left icon input">
								    <div class="ui small action input">
									 		<input type="file" name="field[{{$key}}][file]" id="fi" />
									</div>
								  </div>
								</div>
						      </td>
						      <td width="100">
						      	<div class="field">
						      		<input name="field[{{$key}}][version]" type="number" min="{{$doc->version}}" value="{{$doc->version + 0.1 }}" step="0.1" >
						      	</div>
						      </td>
						    </tr>
						    @endif
						  @endforeach
					  </tbody>
					</table>
					<button class="right floated yellow ui button" id="new_project">
			          Upload
			      </button>
				</form>
			@endif
		@else
			<form class="ui large form" action="/createBaseline" method="post" enctype="multipart/form-data" id="newBaseline" data-exists="false">
			    {{csrf_field()}}
					<table class="ui celled structured table" class="new_baseline_table" style="text-align: center;">
				  <thead>
				    <tr>
				      <th colspan="3">@lang('strings.uploadBaselineDocs')</th>
				    </tr>
				  </thead>
				  <tbody id="docsTableBody">


				  </tbody>
				  <tfoot>
				  	<tr>
				    	<td><a class="ui icon green"><i class="plus green icon link" id="addDocument"></i></a></td>
				    </tr>
				   </tfoot>
				</table>
				<button class="right floated yellow ui button" id="new_project">
	          		@lang('strings.upload')
	      		</button>
			</form>
		@endif
	</div>

</div>


    <script src="{{ URL::asset('/js/custom.js') }}"></script>
	<script src="{{URL::asset('js/newBaseline.js')}}" ></script>

