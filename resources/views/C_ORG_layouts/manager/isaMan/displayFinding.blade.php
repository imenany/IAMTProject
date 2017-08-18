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
            <tr class="{!! ( strpos($finding->cycle, 'R') !== false) ? 'active' : '' !!}">
                <td> {{$finding->finding}} </td>
                <td> {{$finding->cycle}} </td>
                <td> 
                    @if(strpos($finding->cycle, 'O') !== false)
                        <div id="description{{$finding->id}}" data-html="{{$finding->description}}"> {{substr($finding->description,0,50)}}...</div>
                    @else 
                        <div id="description{{$finding->id}}" data-html="{{$finding->response}}"> {{substr($finding->response,0,50)}}...</div>
                    @endif
                </td>
                <td> {{$finding->document->title}} </td>
                <td> <div id="recommendation{{$finding->id}}" data-html="{{$finding->recommendation}}"> {{substr($finding->recommendation,0,20)}}...</div> </td>
                <td> {{$finding->status}} </td>
                <td> {{$finding->severity}} </td>
                <td> {{$finding->created_at}} </td>
                <td> {{$finding->user->first_name}} {{$finding->user->last_name}} </td>
                <td> {{$finding->updated_at}} </td>
                <td>

                    @if($finding->id == $findings->last()->id && strpos($finding->cycle, 'O') !== false)
                        <i class="reply icon orange large link response" data-finding="{{$finding->id}}"></i>
                    @elseif($finding->id == $findings->last()->id && strpos($finding->cycle, 'R') !== false)
                        @lang('strings.waitingResponseAssessor')
                    @endif


                </td>
            </tr>
        @endforeach
        </tbody>
      </table>

  </div>
  
    
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/listFindings.js') }}"></script>

