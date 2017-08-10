
<div class="ui middle aligned center aligned grid">
  <div class="column">
  <h3>@lang('strings.uploadDocument') </h3>
@if(isset($baselines))
  @if($baselines == "opened")
      <form class="ui large form" action="/storeFile" method="post" enctype="multipart/form-data" id="formUpload">
      {{csrf_field()}}
        <div class="ui stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <div class="ui small action input" id="upload_input">
                <input type="file" name="files[]" multiple required="true">
                <button class="ui button submit" type="submit"><i class="upload icon"></i> @lang('strings.upload')</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    @if (Session::has('message'))
       <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
  @else 
  <p><div class="ui red message notif_message" style="width: 50%; margin: 0 auto;">
                <div class="header">@lang('strings.thereisnobaselinemessage')</div>
            </div></p>
  @endif

@endif
    @if(!empty($ok))
            @if($ok == "yes")
              <p><div class="ui green message notif_message" style="width: 50%; margin: 0 auto;">
              <div class="header">Your files has been uploaded</div>
          </div></p>
      @else
        <p><div class="ui red message notif_message" style="width: 50%; margin: 0 auto;">
              <div class="header">Error</div>
          </div></p>
            @endif
          @endif
  </div>
</div>


    <script src="{{ URL::asset('/js/custom.js') }}"></script>
