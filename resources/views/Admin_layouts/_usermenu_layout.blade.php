<div class="ui menu inverted" id="fixed_top">
    <div class="item">@lang('strings.welcomeBack') <b> {{Auth::user()->first_name}}</b>!</div>
    @if(Session::has('role'))
        <div class="item selectedProj">@lang('strings.loggedAs') <b>: {{Session::get('role')}}</b></div>
    @endif

    @if(Session::has('currentProject'))
    <div class="right menu" >
        <div class="item selectedProj"><b><h2>{{Session::get('currentProjectName')}}</h2></b></div>
    </div>
    @endif

    <div class="right menu" >
    <div class="item ui dropdown">  <i class="world icon"></i> {{ Config::get('languages')[App::getLocale()] }}
        <i class="caret down icon link"></i>
        <div class="ui menu">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <a href="{{ route('lang.switch', $lang) }}" class="item">{{$language}}</a>
            @endif
        @endforeach
        </div>
    </div>
    
    @if(Session::has('currentProject'))
           <input type="text" class="hidden" name="projID" value="{{ Session::get('currentProject') }}"/>
    @endif

    <div class="item"><i class="setting icon link" id="settings"></i></div>
    <a class="item" href="{{ url('/logout') }}"><i class="sign out icon"></i> @lang('strings.signOut') </a>
    </div>
</div>  