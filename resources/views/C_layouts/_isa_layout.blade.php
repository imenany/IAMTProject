<div id="content2">
    <div class="ui menu top_menu">
      <div class="header item" id="ISA_title">
            ISA
      </div>
      <div class="item right">
        <i class="sort descending icon link" id="show_isa"></i>
      </div>
    </div>        

    <div class="ui" id="ISA">
        <div class="ui secondary vertical pointing menu" id="ISA_menu">
          <div class="ui dropdown item">
            <i class="dropdown icon"></i>
            @lang('strings.findingsMan')
            <div class="menu">
              <a class="item">@lang('strings.displayFindings')</a>
              <a class="item">@lang('strings.addFinding')</a>
              <a class="item">@lang('strings.modifyFinding')</a>
              <a class="item">@lang('strings.modifiedFindings')</a>
            </div>
          </div>

          <div class="ui dropdown item">
            <i class="dropdown icon"></i>
            @lang('strings.findingsRegMan')
            <div class="menu">
              <a class="item">@lang('strings.createROBS')</a>
              <a class="item">@lang('strings.qualityReview')</a>
              <a class="item">@lang('strings.defineDocAcce')</a>
            </div>
          </div>

          <div class="ui dropdown item">
            <i class="dropdown icon"></i>
            @lang('strings.projProperties')
            <div class="menu">
              <a class="item">@lang('strings.projPhasesMan')</a>
              <a class="item">@lang('strings.projParticipant')</a>
              <a class="item">@lang('strings.defineDocAcce')</a>
            </div>
          </div>

          <a class="item">
                @lang('strings.displayProgress')
          </a>
        </div>
        <div id="ISA_content">
            @yield('ISA_content')
        </div>
    </div>
</div>