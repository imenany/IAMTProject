@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <form class="ui large form" method="POST" action="{{ route('password.email') }}">
            <div class="ui stacked segment">

                {{ csrf_field() }}

            <div class="field">
                <img src="{{ URL::asset('img/viattechlogo.png') }}" class="image">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                        </div>

                        @if ($errors->has('email'))
                        <div class="ui red message">{{ $errors->first('email') }}</div>
                        @endif

                        @if (session('status'))
                        <div class="ui green message">{{ session('status') }}</div>
                        @endif
                </div>
            </div>

            <button type="submit" class="ui button fluid large yellow">
                Send Password Reset Link
            </button>
            
            </div>
        </form>
    </div>
@endsection
