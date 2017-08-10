<div class="ui grid" >
  <div class="wide column">

      <form class="ui form" id="formaddmissingdocalert">
      {{ csrf_field() }}
        <table class="ui definition table">
          <tbody>
            <tr>
              <td class="two wide column">@lang('strings.document')</td>
              <td><input name="document[title]" ></td>
            </tr>

            <tr>
              <td class="two wide column">@lang('strings.phase')</td>
              <td>
                <div class="ui form">
                  <div class="field">
                      <select name="document[phase]">
                        @foreach($normes as $norme)
                          <option value="{{$norme->normesphase->id}}">{{$norme->normesphase->name}}</option>
                        @endforeach
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
                      <select name="document[responsable]">
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
                <div class="fluid yellow ui button" id="SubmitNewMissingDocAlert">@lang('strings.save')</div>
            </div>
          </div>
        </form>

  </div>

    
</div>

<script src="{{ URL::asset('/js/custom.js') }}"></script>
<script src="{{ URL::asset('/js/missingDoc.js') }}"></script>


