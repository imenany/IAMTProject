<div class="ui grid" >
	<div class="wide column">

		<table class="ui celled table datatable">
			<thead>
			<tr>
			    <th>@lang('strings.status')</th>
			    <th>@lang('strings.version')</th>
			    <th>@lang('strings.createdat')</th>
			    <th>@lang('strings.updatedat')</th>
			    <th>@lang('strings.action')</th>
				</tr>
			</thead>
			<tbody>
			@if(isset($baseline))
				@if($baseline->status == "opened" || $baseline->status == "locked")
				    <tr>
						<td class="status">{{$baseline->status}}</td>
						<td>{{number_format($baseline->version,1, '.', ' ')}}</td>
						<td>{{$baseline->created_at}}</td>
						<td>{{$baseline->updated_at}}</td>
						<td class="one wide">
						@if($baseline->status == "opened")
							<i class="lock red large link icon lock" data-baseline="{{$baseline->id}}"></i><span class="lock">@lang('strings.lock')</span>
						@else
							<i class="check square green outline large link icon open" data-baseline="{{$baseline->id}}"></i><span class="open">@lang('strings.open')</span>
						@endif
						</td>
				    </tr>
				@endif
			@endif
			</tbody>
		</table>
	</div>
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/lockBaseline.js') }}"></script>
