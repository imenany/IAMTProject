<div class="ui grid" >
  <div class="wide column">

      <table class="ui celled table datatable" id="missingDocTable">
        <thead>
          <tr>
            <th>@lang('strings.document')</th>
            <th>@lang('strings.phase')</th>
            <th>@lang('strings.responsable')</th>
            <th>@lang('strings.createdat')</th>
            <th>@lang('strings.createdby')</th>
            <th>@lang('strings.updatedat')</th>
            <th>@lang('strings.action')</th>
          </tr>
          </thead>
        <tbody>
        @foreach($documents as $document)
            <tr>
                <td> {{$document->title}} </td>
                <td> {{$document->normephase->name}} </td>
                <td> {{$document->theresponsable->first_name}} {{$document->theresponsable->last_name}}</td>
                <td> {{$document->created_at}} </td>
                <td> {{$document->user->first_name}} {{$document->user->last_name}} </td>
                <td> {{$document->updated_at}} </td>
                <td> 
                    @if($document->valid == 1)
                      <i class="checkmark box large green icon link DocFound" data-doc="{{$document->id}}"></i>
                    @else
                      <i class="remove large red icon link" data-doc="{{$document->id}}"></i>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>

  </div>
  
    
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/missingDoc.js') }}"></script>

