<div id="content2">
    <div class="ui menu top_menu">
      <div class="header item" id="ISA_title">
            ISA
      </div>
      <div class="header item" >
          <h1 id="page_title"></h1>
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
              <a class="item" id="showAllFindings">@lang('strings.displayFindings')</a>
              <a class="item" id="showAddFinding">@lang('strings.addFinding')</a>
              <a class="item" id="showModifyFinding">@lang('strings.modifyFinding')</a>
              <a class="item" id="showModifiedFindings">@lang('strings.modifiedFindings')</a>
            </div>
          </div>


          <a class="item" id="showQualityReview">@lang('strings.qualityReview')</a>

          <a class="item">
                @lang('strings.displayProgress')
          </a>
        </div>
        <div id="ISA_content">
            
        </div>
    </div>
</div>