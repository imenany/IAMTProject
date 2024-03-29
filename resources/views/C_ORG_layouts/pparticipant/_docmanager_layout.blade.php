<div id="content1">
    <div class="ui menu top_menu">
      <div class="header item" id="doc_man_title">
            @lang('strings.docManTitle')
      </div>
      <a class="item">
            <div class="ui icon input">
                  <input placeholder="Search..." type="text">
                  <i class="search icon"></i>
            </div>
        </a>
        <div class="header item">
          <h3 class="ui header" id="doc_title"></h3>
      </div>
        <div class="item right">
            <i class="sort descending icon link" id="show_man"></i>
      </div>
    </div>
    <div class="ui" id="doc_man">
        <div class="ui secondary vertical pointing menu" id="doc_man_menu">
          <div class="ui dropdown item">
            <i class="dropdown icon"></i>
              @lang('strings.docManTitle')
            <div class="menu">
              <a class="item" id="showuploadFile">@lang('strings.uploadDocument')</a>
              <a class="item" id="showviewDocuments" >@lang('strings.readDocument')</a>
              <a class="item" id="showallDocuments2" >@lang('strings.modifyDocument')</a>
            </div>
          </div>
          <a class="item" id="showallBaselines">
                @lang('strings.displayBaselines')
          </a>
          <a class="item" id="showallDocuments">
                @lang('strings.displayDocuments') 
            </a>
        </div>
        <div id="doc_man_content">
            @yield('doc_manager_content')
        </div>
    </div>
</div>
