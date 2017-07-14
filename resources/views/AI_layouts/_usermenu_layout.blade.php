<div class="ui menu inverted" id="fixed_top">
    <div class="item">@lang('strings.welcomeBack') <b> {{Auth::user()->first_name}}</b>!</div>
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
    <div class="item ui dropdown">@lang('strings.loggedAs') <b>: {{Auth::user()->fonction}}</b><i class="caret down icon link"></i>
        <div class="ui menu">
            <a class="item active">Administrator</a>
            <a class="item">Lead Assessor</a>
            <a class="item">Assessor</a>
            <a class="item">Project Manager </a>
            <a class="item">QA</a>
            <a class="item">Approver</a>
            <div class="ui inverted divider"></div>
            <a class="item">Manager</a>
            <a class="item">Project Participant</a>
            <a class="item">Guest</a>
        </div>  
    </div>
    <div class="item"><i class="setting icon link" id="settings"></i></div>
    <a class="item" href="{{ url('/logout') }}"><i class="sign out icon"></i> @lang('strings.signOut') </a>
    </div>
</div>