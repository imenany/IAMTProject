@extends('main_layout')

@section('title', 'Show Documents')

@section('doc_manager_content')

<div class="ui grid">
	<div class="three wide column">
		<div class="ui list">
			<div class="ui" id="loading_files">
	  		<div class="ui active inverted dimmer">
	    		<div class="ui text loader">Loading</div>
	  		</div>
	  		<p></p>
			</div>
			@foreach($baselines as $baseline)
				<div class="item">
					<i class="folder icon"></i>
					<div class="content">
			            <div class="header"><a class="expand">Baseline # {{$baseline->version}}</a></div>
			            <div class="list hidden">
							@foreach($baseline->documents as $document)
								<div class="item">
								    <i class="file icon"></i>
								    <div class="content">
								    	<div class="header"><a class="show_file" name="{{$document->title}}" data-url="{{$document->url}}" >{{$document->title}}</a></div>
								    </div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

  	<div class="thirteen wide column">
		<div class="ui hidden" id="loading_preview">
	  		<div class="ui active inverted dimmer">
	    		<div class="ui massive text loader">Loading</div>
	  		</div>
	  		<p></p>
		</div>
		<div id="files_reader">
			
		</div>
  	</div>
</div>


    
@endsection