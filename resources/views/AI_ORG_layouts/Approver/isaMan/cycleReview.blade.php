<div class="ui grid" >
  <div class="wide column">
      <table class="ui celled table datatable" id="cycleReviewTable">
        <thead>
          <tr>
            <th>ROBS</th>
            <th>View</th>
            <th>Lead Assessor</th>
            <th>Assessor</th>
            <th>Project Manager</th>
            <th>QA</th>
            <th>Created By</th>
            <th>Created AT</th>
            <th>Updated AT</th>
            <th>Action</th>
            <th>Edit</th>
            <th>Comment</th>
          </tr>
          </thead>
        <tbody>
        @foreach($ROBS as $document)
            <tr>
                <td>{{$document->title}}</td>
                <td><a href="{{str_replace('/public/', '/storage/', $document->url)}}" download><i class="download icon large "></i></a></td>
                <td>
                  @if($document->leadassessor == 1)
                      <i class="checkmark box large green icon  disabled"></i>
                  @else <i class="remove large red icon disabled"></i>
                  @endif
                </td>
                <td>
                  @if($document->assessor == 1)
                      <i class="checkmark box large green icon disabled"></i>
                  @else <i class="remove large red icon disabled"></i>
                  @endif
                </td>
                <td>
                  @if($document->projectmanager == 1)
                      <i class="checkmark box large green icon  disabled"></i>
                  @else <i class="remove large red icon disabled"></i>
                  @endif
                </td>
                <td>
                  @if($document->qa == 1)
                      <i class="checkmark box large green icon  disabled"></i>
                  @else <i class="remove large red icon disabled"></i>
                  @endif
                </td>
                <td>{{$document->user->first_name}} {{$document->user->last_name}}</td>
                <td>{{$document->created_at}}</td>
                <td>{{$document->updated_at}}</td>
                <td>
                 @if($document->leadassessor != 1)
                  @if($document->qa > 0)
                    @if($document->approver == 0)
                      <i class="checkmark box large green icon link validateApprover" data-doc="{{$document->id}}" data-user="approver"></i>
                    @else
                      <i class="remove large red icon link unValidateApprover" data-doc="{{$document->id}}" data-user="approver"></i>
                    @endif
                  @else
                    <i class="checkmark box large red icon disabled"></i>
                  @endif
                @else
                  Validated!
                @endif
                </td>
                <td>
                <i class="edit box large green icon link editRobsFindings" data-doc="{{$document->id}}" data-user="qa"></i>
              </td>
              <td>
                <i class="comment large green icon link addFindingComment" data-doc="{{$document->id}}" data-user="{{Auth::user()->id}}"></i>
              </td>
            </tr>
        @endforeach
        </tbody>
      </table>

  </div>
  
    
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/cycleReview.js') }}"></script>


