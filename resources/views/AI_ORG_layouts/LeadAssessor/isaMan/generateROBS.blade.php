<div class="ui grid" >
  <div class="wide column">
  	<form id="GenerateROBSForm">
      <table class="ui celled table datatable" >
        <thead>
          <tr>
            <th>@lang('strings.action')</th>
            <th>@lang('strings.finding')</th>
            <th>@lang('strings.cycle')</th>
            <th>@lang('strings.description')</th>
            <th>@lang('strings.relatedDoc')</th>
            <th>@lang('strings.recommendation')</th>
            <th>@lang('strings.status')</th>
            <th>@lang('strings.severity')</th>
            <th>@lang('strings.createdat')</th>
            <th>@lang('strings.createdby')</th>
            <th>@lang('strings.updatedat')</th>
          </tr>
          </thead>
        <tbody>
        @foreach($findings as $finding)
            <tr>
            	<td> <input type="checkbox" name="finding[{{$finding->last()->id}}]"></td>
                <td> {{$finding->last()->finding}} </td>
                <td> {{$finding->last()->cycle}} </td>
                <td> <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->description}}"> {{substr($finding->last()->description,0,50)}}...</div> </td>
                <td> {{$finding->last()->document->title}} </td>
                <td> <div id="recommendation{{$finding->last()->id}}" data-html="{{$finding->last()->recommendation}}"> {{substr($finding->last()->recommendation,0,20)}}...</div> </td>
                <td> {{$finding->last()->status}} </td>
                <td> {{$finding->last()->severity}} </td>
                <td> {{$finding->last()->created_at}} </td>
                <td> {{$finding->last()->user->first_name}} {{$finding->last()->user->last_name}} </td>
                <td> {{$finding->last()->updated_at}} </td>
            </tr>
        @endforeach
        </tbody>
      </table>
      	<div class="ui grid segment">
      <div class="ui four wide column"></div>
      <div class="ui four wide column">
          <div class="fluid yellow ui button" id="generateROBSPDFButton">Generate ROBS PDF</div>
      </div>
			<div class="ui four wide column">
		        <div class="fluid yellow ui button" id="generateROBSXLSButton">Generate ROBS XLS</div>
            <a href="" id="download" download class="hidden"><span>link</span> </a>

		    </div>
	    </div>

	</form>
  </div>
  
    
</div>


    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/listFindings.js') }}"></script>
