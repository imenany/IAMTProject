<div class="ui left vertical inverted hidden" id="left_menu_div" >
    <div class="item" style="height: 6vh;">
           <a class="ui logo icon image">
        <i class="large align justify icon link" id="show_menu"></i><br>
        </a>
    </div>
</div>

<div class="ui left top vertical menu inverted" id="left_menu" style="left: 0px; top: 0px; width: 250px !important; margin-top: 0px;">
    
    <div class="item logotitle">
      <a href="/"><img src="{{ URL::asset('/img/viattech.png') }}" height="25px" /></a>
      <a class="ui logo icon image">
            <i class="large align justify icon link" id="hide_menu"></i>
        </a>
    </div>

    <a class="item" href="{{ url('/listProjects') }}" >@lang('strings.projectMan')</a>
    <a class="item" href="{{ url('/listUsers') }}">@lang('strings.usersMan')</a>
    <!--div class="menu" id="leftbar_projects">
    </div-->
    
    <div class="item">
      <button class="fluid yellow ui button" id="new_project">
          @lang('strings.newProject')
      </button>
    </div>

    <div class="item">
      <button class="fluid yellow ui button" id="new_user">
          @lang('strings.newUser')
      </button>
    </div>
    
    <!--div class="ui cards">
          <div class="card">
            <div class="content">
                <div class="header center aligned">Project 1</div>
                <div class="center aligned">Baseline <b>1.0</b></div>
                <div class="ui progress">
                    <div class="ui success progress" data-percent="74" id="example1">
                    <div class="bar"></div>
                </div>
                </div>
            </div>
            <div class="ui bottom attached button">
              <i class="add icon"></i>
                Project Properties
            </div>
          </div>    
    </div>-->
</div>


