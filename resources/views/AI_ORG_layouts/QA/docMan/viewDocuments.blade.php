
<div class="ui grid">
	<div class="three wide column">
		<div class="ui list">
		<h3 id="document_title">Preview Files</h3>

			@foreach($baselines as $baseline)
				<div class="item">
					<i class="folder icon"></i>
					<div class="content">
			            <div class="header"><a class="expand">Baseline # {{$baseline->version}}</a></div>
			            <div class="list hidden">

							@foreach($baseline->documents as $document)
								@if($document->valid == 1)
									<div class="item">
									    <i class="file icon"></i>
									    <div class="content">
									    	<div class="header"><a class="show_file" name="{{$document->title}}" data-url="{{$document->url}}" >{{$document->title}}</a></div>
									    </div>
									</div>
								@endif
							@endforeach

							@foreach($baseline->documentsai as $document)
								@if($document->accessibility == 1)
									<div class="item">
									    <i class="file icon"></i>
									    <div class="content">
									    	<div class="header"><a class="show_file" name="{{$document->title}}" data-url="{{$document->url}}" >{{$document->title}}</a></div>
									    </div>
									</div>
								@endif
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

<script src="{{ URL::asset('/js/custom.js') }}"></script>
<script src="{{ URL::asset('/js/viewDocument.js') }}"></script>
