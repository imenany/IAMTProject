

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('semantic/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
    

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
      background-color: #D9E8F5;
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
  @yield('content')


  </div>
</div>


</body>


</html>


