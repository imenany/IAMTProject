<div class="ui grid" >
  <div class="wide column">
      <table class="ui celled table datatable" id="findingstable">
        <thead>
          <tr>
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
            <th>@lang('strings.action')</th>
          </tr>
          </thead>
        <tbody>
        @foreach($findings as $finding)
            @if($finding->last()->valid == 1)
                <tr>
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
                    <td> <i class="add circle icon orange large link more" data-finding="{{$finding->last()->id}}"></i></td>
                </tr>
            @endif
        @endforeach
        </tbody>
      </table>

  </div>
  
    
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/listFindings.js') }}"></script>

