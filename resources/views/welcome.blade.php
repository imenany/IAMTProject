<!DOCTYPE html>
<html>
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('semantic/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
    
    
    @yield('styles')

    <title>IAMT - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>

    @if(Auth::user()->access == 2)

        @include('C_layouts._leftmenu_layout')
        @include('C_layouts._usermenu_layout')
        @include('AI_layouts._modals_layout')

    @elseif(Auth::user()->access == 1)

        @include('AI_layouts._leftmenu_layout')
        @include('AI_layouts._usermenu_layout')
        @include('AI_layouts._modals_layout')

    @endif

</body>

<!-- Scripts -->
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.resize.js') }}"></script>
    <script src="{{ URL::asset('semantic/semantic.min.js') }}"></script>
    <script src="{{ URL::asset('js/custom.js') }}"></script>
    <script src="{{ URL::asset('js/left_bar_data.js') }}"></script>
    
    @yield('scripts')
    
</html>
