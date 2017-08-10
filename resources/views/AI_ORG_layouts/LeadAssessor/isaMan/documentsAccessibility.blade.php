<div class="ui grid" >
  <div class="wide column">
      <table class="ui celled table datatable" id="DocAccessibilityTable">
        <thead>
          <tr>
            <th>ROBS</th>
            <th>View</th>
            <th>Created By</th>
            <th>Created AT</th>
            <th>Updated AT</th>
            <th>C_ORG Acessibility</th>
            <th>Action</th>
          </tr>
          </thead>
        <tbody>
        @foreach($ROBS as $document)
        @if($document->valid == 1)
            <tr>
                <td>{{$document->title}}</td>
                <td><a href="{{str_replace('/public/', '/storage/', $document->url)}}" download><i class="download icon large "></i></a></td>
                <td>{{$document->user->first_name}} {{$document->user->last_name}}</td>
                <td>{{$document->created_at}}</td>
                <td>{{$document->updated_at}}</td>
                <td>
                  @if($document->accessibility == 0)
                      <span class="hidetxt">Hidden</span>
                  @else
                    <span class="hidetxt">Visible</span>
                  @endif
                </td>
                <td>
                    @if($document->accessibility == 0)
                      <i class="unhide large icon link" data-doc="{{$document->id}}"></i>
                  @else
                        <i class="hide large red link icon" data-doc="{{$document->id}}"></i>
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
    <script src="{{ URL::asset('/js/DocAccessibility.js') }}"></script>
