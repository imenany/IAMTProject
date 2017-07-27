<div class="ui grid" >
	<div class="wide column">

			<table class="ui celled table datatable">
			  <thead>
			    <tr>
			    	<th>@lang('strings.title')</th>
				    <th>@lang('strings.baseline')</th>
				    <th>@lang('strings.phase')</th>
				    <th>@lang('strings.version')</th>
				    <th>@lang('strings.createdby')</th>
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
						<td>@if($doc->baseline){{$doc->baseline->version}}@endif</td>
						<td>@if($doc->phase){{$doc->normesphase->name}}@endif</td>
						<td>@if($doc->version){{$doc->version}}@endif</td>
						<td>@if($doc->user){{$doc->user->first_name}} {{$doc->user->last_name}}@endif</td>
						<td>{{$doc->created_at}}</td>
						<td>{{$doc->updated_at}}</td>
						<td>
						@if($doc->valid == 0 && $doc->baseline->status == "opened") 
							<i class="checkmark box green large icon link validate" data-doc="{{$doc->id}}"></i> 
							<i class="remove red large icon link remove" data-doc="{{$doc->id}}"></i>
							<div class="hidden"><i class="edit link large blue icon editshow" data-doc="{{$doc->id}}"></i></div>
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
