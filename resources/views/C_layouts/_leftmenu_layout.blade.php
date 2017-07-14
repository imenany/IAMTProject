<div class="ui left vertical inverted hidden" id="left_menu_div" >
    <div class="item" style="height: 6vh;">
           <a class="ui logo icon image">
        <i class="large align justify icon link" id="show_menu"></i><br>
        </a>
    </div>
</div>

<div class="ui left top vertical menu inverted" id="left_menu" style="left: 0px; top: 0px; width: 250px !important; margin-top: 0px;">
    
    <div class="item">
      <a href="/"><b>IAMT</b></a>
      <a class="ui logo icon image">
            <i class="large align justify icon link" id="hide_menu"></i>
        </a>
    </div>

    <div class="item">
      <div class="header"><h3>@lang('strings.projects')</h3></div>
      <div class="menu" id="leftbar_projects">
      </div>
     
    </div>

    <div class="item">
      <div class="header"><h3>@lang('strings.notifications')</h3></div>
      <div class="ui middle aligned divided list" id="leftbar_projects">
        <div class='item'>
          <div class='content'>
            <div class="right floated content">
              <div class="ui small yellow label">1</div>
            </div>
            <a class='header'>@lang('strings.findings')</a>
          </div>
        </div>
        <div class='item'>
          <div class="right floated content">
              <div class="ui small yellow label">2</div>
            </div>
          <div class='content'>
            <a class='header'>@lang('strings.documents')</a>
          </div>
        </div>
        <div class='item'>
          <div class="right floated content">
              <div class="ui small label">0</div>
          </div>
          <div class='content'>
            <a class='header'>@lang('strings.reviewing')</a>
          </div>
        </div>
      </div>
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


