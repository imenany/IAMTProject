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
    <form class="ui large form">
      <div class="ui stacked segment">
        <div class="field">
          <img src="img/viattechlogo.png" class="image">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" placeholder="E-mail address">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>
        <a href="{{ url('/') }}">
        <div class="ui fluid large teal submit button">Login</div></a>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      New to us? <a href="{{ url('/') }}">Sign Up</a>
    </div>
  </div>
</div>


</body>


</html>