@extends('main_layout')

@section('title', 'List Of Baselines')

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
				    <th>Status</th>
				    <th>Version</th>
				    <th>Created At</th>
				    <th>Updated At</th>
			  	</tr>
			  	</thead>
			  <tbody>
				@foreach($baselines as $baseline)
				    <tr>
						<td>{{$baseline->status}}</td>
						<td>{{number_format($baseline->version,1, '.', ' ')}}</td>
						<td>{{$baseline->created_at}}</td>
						<td>{{$baseline->updated_at}}</td>
				    </tr>
				@endforeach
			  </tbody>
			</table>

	</div>

  	
</div>


    
@endsection