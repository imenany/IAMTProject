<div class="ui grid" >
  <div class="wide column">

      <form class="ui form" id="formaddfinding">
      {{ csrf_field() }}
        <table class="ui definition table">
          <tbody>
            <tr>
              <td class="two wide column">@lang('strings.Finding')</td>
              <td><input name="finding[finding]" ></td>
            </tr>
            <tr>
              <td class="two wide column">@lang('strings.relatedDoc')</td>
              <td>
                 <div class="ui form">
                  <div class="field">
                      <select name="finding[document]">
                        @foreach($documents as $document)
                          <option value="{{$document->id}}">{{$document->title}} </option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="two wide column">@lang('strings.description')</td>
              <td><textarea name="finding[description]"></textarea></td>
            </tr>
            <tr>
              <td class="two wide column">@lang('strings.recommendation')</td>
              <td><textarea name="finding[recommendation]"></textarea></td>
            </tr>
            <tr>
              <td>@lang('strings.severity')</td>
              <td>
                <div class="ui form">
                  <div class="field">
                      <select name="finding[severity]">
                        <option value="NA">NA</option>
                        <option value="MIN">MIN</option>
                        <option value="MAJ">MAJ</option>
                        <option value="CRIT">CRIT</option>
                      </select>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td class="two wide column">@lang('strings.responsable')</td>
              <td>
                <div class="ui form">
                  <div class="field">
                      <select name="finding[responsable]">
                        @foreach($users as $user)
                          <option value="{{$user->user->id}}">{{$user->user->first_name}} {{$user->user->last_name}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
        <div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
        <div class="ui grid segment">
          <div class="ui twelve wide column"></div>
          <div class="ui four wide column">
                <div class="fluid yellow ui button" id="SubmitChanges">@lang('strings.save')</div>
            </div>
          </div>
        </form>

  </div>

    
</div>

<script src="{{ URL::asset('/js/custom.js') }}"></script>
<script src="{{ URL::asset('/js/newFinding.js') }}"></script>


