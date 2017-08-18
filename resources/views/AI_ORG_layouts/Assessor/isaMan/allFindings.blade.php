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
            @if(count($finding)>1)
                <tr>
                    <td rowspan="2"> {{$finding->first()->finding}} </td>
                    <td> {{$finding->first()->cycle}} </td>
                    <td> 
                        @if(strpos($finding->first()->cycle, 'O') !== false)
                            <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->description}}"> {{substr($finding->last()->description,0,50)}}...</div>
                        @else 
                            <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->response}}"> {{substr($finding->last()->response,0,50)}}...</div>
                    @endif
                    </td>
                    <td rowspan="2"> {{$finding->first()->document->title}} </td>
                    <td> <div id="recommendation{{$finding->first()->id}}" data-html="{{$finding->first()->recommendation}}"> {{substr($finding->first()->recommendation,0,20)}}...</div> </td>
                    <td rowspan="2"> {{$finding->first()->status}} </td>
                    <td> {{$finding->first()->severity}} </td>
                    <td> {{$finding->first()->created_at}} </td>
                    <td rowspan="2"> {{$finding->first()->user->first_name}} {{$finding->first()->user->last_name}} </td>
                    <td> {{$finding->first()->updated_at}} </td>
                    <td rowspan=2> 
                    <i class="add circle icon orange large link more" data-finding="{{$finding->first()->id}}"></i>
                        @if($finding->first()->valid == 0 && $finding->first()->accessibility == 0) 
                        <i class="checkmark box green large icon link validate" data-finding="{{$finding->first()->id}}"></i>
                        <i class="remove red large icon link remove" data-finding="{{$finding->first()->id}}"></i>
                        @endif
                    </td>
                </tr>
            @if($finding->last()->valid == 0)
                <tr class="active">
            @else
                <tr class="{!! ( strpos($finding->last()->cycle, 'R') !== false) ? 'lightYellow' : '' !!}">
            @endif
                    <td> {{$finding->last()->cycle}} </td>
                    <td> 
                    @if(strpos($finding->last()->cycle, 'O') !== false)
                        <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->description}}"> {{substr($finding->last()->description,0,50)}}...</div>
                    @else 
                        <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->response}}"> {{substr($finding->last()->response,0,50)}}...</div>
                    @endif
                    <td> <div id="recommendation{{$finding->last()->id}}" data-html="{{$finding->last()->recommendation}}"> {{substr($finding->last()->recommendation,0,20)}}...</div> </td>
                    <td> {{$finding->last()->severity}} </td>
                    <td> {{$finding->last()->created_at}} </td>
                    <td> {{$finding->last()->updated_at}} </td>
                </tr>
            @else
                <tr>
                    <td> {{$finding->first()->finding}} </td>
                    <td> {{$finding->first()->cycle}} </td>
                    <td> 
                        @if(strpos($finding->first()->cycle, 'O') !== false)
                            <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->description}}"> {{substr($finding->last()->description,0,50)}}...</div>
                        @else 
                            <div id="description{{$finding->last()->id}}" data-html="{{$finding->last()->response}}"> {{substr($finding->last()->response,0,50)}}...</div>
                    @endif
                    </td>
                    <td> {{$finding->first()->document->title}} </td>
                    <td> <div id="recommendation{{$finding->first()->id}}" data-html="{{$finding->first()->recommendation}}"> {{substr($finding->first()->recommendation,0,20)}}...</div> </td>
                    <td> {{$finding->first()->status}} </td>
                    <td> {{$finding->first()->severity}} </td>
                    <td> {{$finding->first()->created_at}} </td>
                    <td> {{$finding->first()->user->first_name}} {{$finding->first()->user->last_name}} </td>
                    <td> {{$finding->first()->updated_at}} </td>
                    <td> 
                    <i class="add circle icon orange large link more" data-finding="{{$finding->first()->id}}"></i>
                        @if($finding->first()->valid == 0 && $finding->first()->accessibility == 0) 
                        <i class="checkmark box green large icon link validate" data-finding="{{$finding->first()->id}}"></i>
                        <i class="remove red large icon link remove" data-finding="{{$finding->first()->id}}"></i>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
      </table>

  </div>
  
    
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/listFindings.js') }}"></script>

