@extends('Admin_layouts.adminContent')

@section('title', 'Projects Management')

@section('body')

<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item">
          <h1>@lang('strings.newProject')</h1>
      </div>
    </div>
<div id="admin_content" >
  <div class="ui grid" >

    <div class="sixteen wide column" style="border-radius: 0;">
      <form class="ui form" action="/insertNewProject" method="post" id="theForm">
       {{ csrf_field() }}
       
      
<div class="ui three top attached steps">
  <div class="active step" id="firsttabtitle">
    <i class="info circle icon"></i>
    <div class="content">
      <div class="title">@lang('strings.projInfo')</div>
      <div class="description">@lang('strings.projInfoDesc')</div>
    </div>
  </div>
  <div class="disabled step" id="secondtabtitle">
    <i class="checkmark icon"></i>
    <div class="content">
      <div class="title">@lang('strings.projSTD')</div>
      <div class="description">@lang('strings.projSTDDesc')</div>
    </div>
  </div>
  <div class="disabled step" id="thirdtabtitle">
    <i class="users icon"></i>
    <div class="content">
      <div class="title">@lang('strings.projIntervenants')</div>
      <div class="description">@lang('strings.projIntervenantsDesc')</div>
    </div>
  </div>
</div>
<div class="ui attached segment">
      <div class="" id="firsttab">
        <h2 class="ui dividing header">@lang('strings.projInfo')</h2>
            <input name="Project[id]" hidden="" value="false">
            <div class="field">
              <label>@lang('strings.title')</label>
              <div class="field">
                  <input name="Project[title]" placeholder="Title" type="text" required="">
              </div>
            </div>
            <div class="field">
              <label>@lang('strings.description')</label>
              <div class="field">
                <div class="field">
                   <textarea rows="2" name="Project[description]"></textarea>
                </div>
              </div>
            </div>
            <div class="two fields">
              <div class="field">
                <label>@lang('strings.startDate')</label>
                <div class="field">
                  <div class="ui calendar" id="dateStart">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input name="Project[dateD]" placeholder="DD-MM-YYYY" type="text">
                      </div>
                    </div>
                </div>
              </div>
              <div class="field">
                <label>@lang('strings.endDate')</label>
                <div class="field">
                    <div class="ui calendar" id="dateEnd">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input name="Project[dateF]" placeholder="DD-MM-YYYY" type="text">
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="ui red message hidden" id="message">@lang('strings.fillAllMessage')</div>
            <div class="ui divider"></div>
              <div class="field">
                <div class="ui grid">
                  <div class="ui four wide column">
                  </div>
                  <div class="ui eight wide column"></div>
                  <div class="ui four wide column">
                    <div class="ui fluid button" tabindex="0" id="Next1">
                        @lang('strings.next')
                      </div>
                  </div>
                </div>
              </div>
      </div>
      <div class="hidden" id="secondtab">
          <h2 class="ui dividing header">@lang('strings.projSTD')</h2>
            <div class="field">
              <div class="three fields">
                @foreach($normes as $norme)
                <div class="field {!! (strcmp($norme->name,'EN50128')) == 0 ? 'hidden': '' !!}" id="{!! (strcmp($norme->name,'EN50128')) == 0 ? 'norme_table': '' !!}" >
                <table class="ui celled table">
                  <thead>
                    <tr>
                      <th colspan="2">{{$norme->name}}</th>
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
                    </td></tr>
                    @endif
                    
                      @if($phase->id == 6 || $phase->id == 7)
                      <tr class="hidden" id="toShow{{$phase->id}}">
                      <td class="ten wide center aligned"><label>{{$phase->name}}</label></td>
                      @else 
                      <tr>
                      <td class="fourteen wide"><label>{{$phase->name}}</label></td>
                      @endif
                      <td>
                        <div class="ui master checkbox" id="phase_{{$phase->id}}">
                          <input name="Phase[{{$phase->id}}]" type="checkbox" >
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                  </div>
                @endforeach
              </div>
            </div>
          <div class="ui divider"></div>
          <div class="field">
            <div class="ui grid">
              <div class="ui four wide column">
                  <div class="ui fluid button" tabindex="0" data-tabnumber="1" id="Previous1">
                    @lang('strings.previous')
                  </div>
              </div>
              <div class="ui eight wide column"></div>
              <div class="ui four wide column">
                <div class="ui four wide column">
                  <div class="ui fluid button" tabindex="0" data-tabnumber="3" id="Next2">
                    @lang('strings.next')
                  </div>
              </div>
              </div>
            </div>
          </div>
      </div>
      <div class="hidden" id="thirdtab">
        <h2 class="ui dividing header">@lang('strings.projIntervenantsDesc')</h2>

        <h3 class="ui dividing header">Select an organisation</h3>
          <div class="ui fluid search selection dropdown">
            <input name="company" type="hidden" id="organisation_name">
            <i class="dropdown icon"></i>
            <div class="default text">Select an organisation</div>
            <div class="menu">
              @foreach($organisations as $organisation)
              @if($organisation != 'Viattech Q&S')
              <div class="item" data-value="{{$organisation}}" data-text="{{$organisation}}">
                {{$organisation}}
              </div>
              @endif
              @endforeach
            </div>
          </div>
        <h4 class="ui dividing header">Select it's intervenant</h4>
          <table class="ui celled sortable striped fluid table datatable" >
            <thead>
              <tr>
                <th class="center aligned" rowspan="3" >@lang('strings.firstname')</th>
                <th class="center aligned" rowspan="3" >@lang('strings.lastname')</th>
                <th class="center aligned" rowspan="3" >@lang('strings.fonction')</th>
                <th class="center aligned" rowspan="3" >@lang('strings.organisation')</th>
                <th class="center aligned" colspan="8">@lang('strings.role')</th>
              </tr>
              <tr>
                <th class="center aligned actif" colspan="5">ISA</th>
                <th class="center aligned actif" colspan="3">Organisation</th>                  
              </tr>
              <tr>
                <th class="center aligned">@lang('strings.leadassessor')</th>
                <th class="center aligned">@lang('strings.assessor')</th>
                <th class="center aligned">@lang('strings.projectManager')</th>
                <th class="center aligned">@lang('strings.QA')</th>
                <th class="center aligned">@lang('strings.approver')</th>
                <th class="center aligned">@lang('strings.manager')</th>
                <th class="center aligned">@lang('strings.projectparticipant')</th>
                <th class="center aligned">@lang('strings.guest')</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              @if($user->organisation == "Viattech Q&S")
              <tr>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->fonction}}</td>
                <td>{{$user->organisation}}</td>
                
                <td class="center aligned">
                   <div class="ui radio checkbox">
                    <input name="role[{{$user->id}}]" tabindex="0" class="hidden" type="radio" value="Lead Assessor">
                   </div>
                </td>
                <td class="center aligned">
                   <div class="ui radio checkbox">
                    <input name="role[{{$user->id}}]" tabindex="0" class="hidden" type="radio" value="Assessor">
                   </div>
                </td>
                <td class="center aligned">
                   <div class="ui radio checkbox">
                    <input name="role[{{$user->id}}]" tabindex="0" class="hidden" type="radio" value="Project Manager">
                   </div>
                </td>
                <td class="center aligned">
                   <div class="ui radio checkbox">
                    <input name="role[{{$user->id}}]" tabindex="0" class="hidden" type="radio" value="QA">
                   </div>
                </td>
                <td class="center aligned">
                   <div class="ui radio checkbox">
                    <input name="role[{{$user->id}}]" tabindex="0" class="hidden" type="radio" value="Approver">
                   </div>
                </td>
                <td colspan="3" class="active"></td>
                @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot id="intervenantsTable">
                
            </tfoot>
          </table>
          <div class="ui divider"></div>
          <div class="field">
            <div class="ui grid">
              <div class="ui four wide column">
                  <div class="ui fluid button" tabindex="0" id="Previous2">
                    @lang('strings.previous')
                  </div>
              </div>
              <div class="ui eight wide column"></div>
              <div class="ui four wide column">
                <div  class="fluid yellow ui button" id="submitform">@lang('strings.createproject')</div>
              </div>
            </div>
          </div>
      </div>
      </div>
</div>





      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('/js/calendar.js') }}"></script>
    <script src="{{ URL::asset('/js/tablesort.js') }}"></script>
    <script src="{{ URL::asset('/js/newproject.js') }}"></script>
@endsection


@section('styles')
    <script src="{{ URL::asset('/css/calendar.css') }}"></script>
@endsection
