
<div class="ui grid" >
	<div class="wide column">

			<table class="ui celled table datatable">
			  <thead>
			    <tr>
				    <th>@lang('strings.status')</th>
				    <th>@lang('strings.version')</th>
				    <th>@lang('strings.createdat')</th>
				    <th>@lang('strings.updatedat')</th>
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



    <script src="{{ URL::asset('/js/custom.js') }}"></script>

