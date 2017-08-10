
<div class="ui grid" >
	<div class="wide column">
			<table class="ui celled table datatable" id="ListOfDocuments">
			  <thead>
			    <tr>
			    	<th>@lang('strings.title')</th>
				    <th>@lang('strings.baseline')</th>
				    <th>@lang('strings.phase')</th>
				    <th>@lang('strings.version')</th>
				    <th>@lang('strings.createdat')</th>
				    <th>@lang('strings.updatedat')</th>
				    <th>@lang('strings.action')</th>
			  	</tr>
			  	</thead>
			  <tbody>
				@foreach($baselines as $baseline)
					@foreach($baseline->documents as $doc)
				    <tr class="{!! ($doc->valid == 0) ? 'active' : '' !!}">
						<td><strong><a class="previewimage" download href="{{str_replace("public/", "storage/", $doc->url)}}" data-html="<img src='{{str_replace("public/", "storage/", $doc->url)}}' width='200px'alt='no preview available'>">{{$doc->title}}</a></strong></td>
						<td>{{$doc->baseline->version}}</td>
						<td>@if($doc->phase){{$doc->normesphase->name}}@endif</td>
						<td>{{$doc->version}}</td>
						<td>{{$doc->created_at}}</td>
						<td>{{$doc->updated_at}}</td>
						<td>
						@if($doc->valid == 0 && $doc->baseline->status == "opened") 
							<i class="edit link large blue icon editshow" data-doc="{{$doc->id}}"></i>
						@elseif($doc->baseline->status == "opened")
							<i class="edit link large blue icon" data-doc="{{$doc->id}}"></i>
							@endif
						</td>
				    </tr>
				    @endforeach
				@endforeach
			  </tbody>
			</table>

	</div>

</div>
    
    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/listDocs.js') }}"></script>