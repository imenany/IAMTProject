

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="semantic/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="semantic/semantic.min.js"></script>

    <title>
        IAMT        
    </title>
    
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style type="text/css">
    body {
      background-color: rgba(34,36,38,.15);
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-bottom: 25px;
    }
    .column {
      max-width: 450px;
    }
  </style>

</head>
<body>



<div class="ui middle aligned center aligned grid">
  <div class="column">
    <form class="ui large form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
      <div class="ui stacked segment">
        <div class="field">
            <img src="img/viattechlogo.png" class="image">
            <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" id="email" name="email" class="form-control" placeholder="E-mail address" value="{{ old('email') }}" required autofocus>
          </div>
        </div>
        <div class="field">
            <div class="ui left icon input">
                <i class="lock icon"></i>
                <input id="password" type="password" class="form-control" name="password" required> 
            </div>
        </div>
        @if ($errors->has('email') || $errors->has('password'))
                <div class="ui negative message">
                    <div class="header">
                        These credentials do not match our records.
                    </div>
                        Please check your email/password.
                </div>
        @endif

        <button type="submit" class="ui button fluid large teal">
                                    Login
                                </button>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      New to us? <a href="{{ route('register') }}">Sign Up</a>
      <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
    </div>
  </div>
</div>


</body>


</html>