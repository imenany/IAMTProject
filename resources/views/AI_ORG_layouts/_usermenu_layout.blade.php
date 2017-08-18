<div class="ui menu inverted" id="fixed_top">
    <div class="hidden" id="authuserid">{{Auth::user()->id}}</div>
    <div class="item"><b>@lang('strings.welcomeBack')  {{Auth::user()->first_name}}!</b></div>
    @if(Session::has('role'))
        <div class="item selectedProjTop">Role <b>: {{Session::get('role')}}</b></div>
    @endif

    {{--@if(Session::has('currentProject'))
    <div class="right menu" >
        <div class="item selectedProjTop"><b>{{Session::get('currentProjectName')}}</b></div>
    </div>
    @endif--}}

    <div class="right menu" >
    <div class="item ui dropdown">  <i class="world icon"></i> <b>{{ Config::get('languages')[App::getLocale()] }}</b>
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

    <a class="item" href="{{ url('/logout') }}"><i class="sign out icon"></i></a>

    </div>
</div>