<form id="phaseManagementForm">

  <h2 class="ui dividing header">@lang('strings.projSTD')</h2>
  <div class="ui grid" >

            @foreach($normes as $norme)
            <div class="five wide column">
            <div class="{!! (strcmp($norme->name,'EN50128')) == 0 ? 'hidden': '' !!}" id="{!! (strcmp($norme->name,'EN50128')) == 0 ? 'norme_table': '' !!}">

              <table class="ui celled table">
                <thead>
                  <tr>
                    <th colspan="2" >{{$norme->name}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($norme->normephases as $phase)
                  @if($phase->id == 6)
                    <tr><td class="fourteen wide"><label>Design and Implementation</label></td>
                      <td>  
                        <div class="ui master checkbox" id="Design">
                          <input type="checkbox">
                        </div>
                      </td>
                    </tr>
                  @endif

                  @if($phase->id == 6 || $phase->id == 7)
                  <tr class="hidden" id="toShow{{$phase->id}}">
                    <td class="ten wide center aligned"><label>{{$phase->name}}</label></td>
                    @else 
                    <tr>
                  <td class="fourteen wide"><label>{{$phase->name}}</label></td>
                  @endif
                  <td>
                      @if(in_array($phase->id,$selectednormes))
                          <div class="ui master checkbox checked" id="phase_{{$phase->id}}">
                      @else <div class="ui master checkbox" id="phase_{{$phase->id}}">
                      @endif
                        <input name="Phase[{{$phase->id}}]" type="checkbox">
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
              </div>
              </div>
            @endforeach
              <div class="ui ten wide column"></div>
              <div class="ui six wide column">
              <div class="fluid yellow ui button" id="saveChangesButton">Save Changes</div>

            </div>
    </div>
      <div class="ui divider"></div>
    
  </div>


</form>

    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    <script src="{{ URL::asset('/js/phasemanagement.js') }}"></script>
