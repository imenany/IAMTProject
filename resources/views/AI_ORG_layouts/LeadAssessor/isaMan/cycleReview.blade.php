<div class="ui grid" >
  <div class="wide column">
      <table class="ui celled table datatable" id="cycleReviewTable">
        <thead>
          <tr>
            <th>ROBS</th>
            <th>View</th>
            <th>Assessor</th>
            <th>Project Manager</th>
            <th>Approver</th>
            <th>QA</th>
            <th>Created By</th>
            <th>Created AT</th>
            <th>Updated AT</th>
            <th>Action</th>
            <th>Comment</th>
          </tr>
          </thead>
        <tbody>
        @foreach($ROBS as $document)
            <tr>
                <td>{{$document->title}}</td>
                <td><a href="{{str_replace('/public/', '/storage/', $document->url)}}" download><i class="download icon large "></i></a></td>
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
                  @if($document->approver == 1)
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
                  @if($document->assessor > 0 && $document->projectmanager > 0 && $document->approver > 0 && $document->qa > 0)
                    @if($document->leadassessor == 0)
                      <i class="checkmark box large green icon link validateApprover" data-doc="{{$document->id}}" data-user="leadassessor"></i>
                    @else
                      <i class="remove large red icon link unValidateApprover" data-doc="{{$document->id}}" data-user="leadassessor"></i>
                    @endif
                  @else
                    <i class="checkmark box large red icon disabled"></i>
                  @endif
                </td>
                <td>
                  <i class="comment large green icon link showROBSComments" data-doc="{{$document->id}}" ></i>
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>

  </div>
  
    
</div>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/cycleReview.js') }}"></script>
