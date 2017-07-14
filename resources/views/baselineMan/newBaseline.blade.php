@extends('main_layout')

@section('title', 'new Baseline')

@section('doc_manager_content')

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
					      <th colspan="3">Upload new baseline documents</th>
					    </tr>
					    <tr>
					      <th>Old document</th>
					      <th>New document</th>
					    </tr>
					  </thead>
					  <tbody>
						  @foreach($exists->documents as $key => $doc)
						    <tr id="AllDocuments">
						      <td>
								<div class="ui stacked">
								<div class="field">
								  <div class="ui left icon input">
								    <div class="ui action input">
									 		<input type="text" disabled value="{{$doc->title}}" required="" />	
									</div>
								  </div>
								</div>
						      </td>
						      <td>
						      	<div class="ui stacked ">
								<div class="field">
								  <div class="ui left icon input">
								    <div class="ui small action input">
									 		<input type="file" name="field{{$key}}" id="fi" required/>
									</div>
								  </div>
								</div>
						      </td>	
						    </tr>
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
				      <th colspan="3">Upload baseline documents</th>
				    </tr>
				  </thead>
				  <tbody id="docsTableBody">
				    <tr class="hidden">
				      <td>
				      	<div class="ui stacked ">
						<div class="field">
						  <div class="ui left icon input">
						    <div class="ui small action input">
							 	<input type="file" name="field1" id="hidden_field1" required="">
							</div>
						  </div>
						</div>
				      </td>	
				    </tr>
				    <tr>
				      <td>
				      	<div class="ui fluid action input">
						  <input placeholder="Browse..." disabled="true" type="text" id="field1">
						  <div class="ui button" id="browse0">Browse</div>
						</div>
				      </td>	
				    </tr>

				  </tbody>
				  <tfoot>
				  <tr>
				    	<td><a class="ui icon green"><i class="plus green icon link" id="addDocument"></i></a></td>
				    </tr>
				    </tfoot>
				</table>
				<button class="right floated yellow ui button" id="new_project">
	          		Upload
	      		</button>
			</form>
		@endif
	</div>

</div>

@endsection

@section('scripts')
	<script src="{{URL::asset('js/newBaseline.js')}}" ></script>
@endsection

