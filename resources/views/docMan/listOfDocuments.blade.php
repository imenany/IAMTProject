@extends('main_layout')

@section('title', 'List Of Documents')

@section('doc_manager_content')

<div class="ui grid" >
	<div class="wide column">
			<div class="ui" id="loading_files">
	  		<div class="ui active inverted dimmer">
	    		<div class="ui text loader">Loading</div>
	  		</div>
	  		<p></p>
			</div>
			<table class="ui celled table datatable">
			  <thead>
			    <tr>
				    <th>Title</th>
				    <th>BaseLine</th>
				    <th>Phase</th>
				    <th>Version</th>
				    <th>Created At</th>
				    <th>Updated At</th>
			  	</tr>
			  	</thead>
			  <tbody>
				@foreach($baselines as $baseline)
					@foreach($baseline->documents as $doc)
				    <tr>
						<td><strong><a class="previewimage" download href="{{str_replace("public/", "storage/", $doc->url)}}" data-html="<img src='{{str_replace("public/", "storage/", $doc->url)}}' width='200px'alt='no preview available'>">{{$doc->title}}</a></strong></td>
						<td>{{$doc->baseline->version}}</td>
						<td>{{$doc->phase}}</td>
						<td>{{$doc->version}}</td>
						<td>{{$doc->created_at}}</td>
						<td>{{$doc->updated_at}}</td>
				    </tr>
				    @endforeach
				@endforeach
			  </tbody>
			</table>

	</div>

  	
</div>


    
@endsection


