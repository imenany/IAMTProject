@extends('layouts.app')

@section('content')
<div class="panel-body">

    <form class="ui large form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <div class="ui stacked segment">

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field">
                <img src="{{ URL::asset('img/viattechlogo.png') }}" class="image">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="ui left icon input">
                        <i class="user icon"></i>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail Address" required autofocus>
                        </div>
                            @if ($errors->has('email'))
                                <div class="ui red message">{{ $errors->first('email')  }}</div>
                            @endif
                    </div>
            </div>

            <div class="field">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        @if ($errors->has('password'))
                            <div class="ui red message">{{ $errors->first('password') }}</div>
                        @endif
                </div>

            </div>
            
            <div class="field">
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repeat password" required>
                        </div>

                        @if ($errors->has('password_confirmation'))
                        <div class="ui red message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                </div>
            </div>

            @if (session('status'))
            <div class="ui green message">{{ session('status') }}</div>
            @endif
            
            <button type="submit" class="ui button fluid large yellow">
                Reset Password
            </button>

        </div>
    </form>
</div>
            
@endsection
