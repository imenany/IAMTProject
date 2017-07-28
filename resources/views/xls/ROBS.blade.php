<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="{{ ltrim(elixir('css/ROBS.css'), '/') }}" />
</head>
<body>



<div align="right" class="logo">
	<img src="{{ ltrim(elixir('img/viattechlogo.png'), '/') }}" alt="placeholder+image" >
    <br><span class="slogan">Your Partner for Quality and Safety Assurance Management</span>

</div>
<h3 align="center">
	Projet : {{$findings->first()->document->baseline->project->title}} - Findings ISA - {{date('l jS \of F Y h:i:s A e')}}
</h3>
      <table class="">
        <thead>
          <tr>
            <th>@lang('strings.finding')</th>
            <th>@lang('strings.cycle')</th>
            <th>@lang('strings.description')</th>
            <th>@lang('strings.relatedDoc')</th>
            <th>@lang('strings.recommendation')</th>
            <th>@lang('strings.status')</th>
            <th>@lang('strings.severity')</th>
            <th>@lang('strings.createdat')</th>
            <th>@lang('strings.createdby')</th>
            <th>@lang('strings.responsable')</th>
            <th>@lang('strings.updatedat')</th>
          </tr>
          </thead>
        <tbody>
        @foreach($findings as $finding)
            <tr class="{!! ( strpos($finding->cycle, 'R') !== false) ? 'lightYellow' : '' !!}">
                <td width="20"> {{$finding->finding}} </td>
                <td width="10"> {{$finding->cycle}} </td>
                <td width="50"> 
                    @if(strpos($finding->cycle, 'O') !== false)
                        <div id="description{{$finding->id}}" data-html="{{$finding->description}}"> {{$finding->description}}</div>
                    @else 
                        <div id="description{{$finding->id}}" data-html="{{$finding->response}}"> {{$finding->response}}</div>
                    @endif
                </td>
                <td width="30"> {{$finding->document->title}} </td>
                <td width="50"> <div id="recommendation{{$finding->id}}" data-html="{{$finding->recommendation}}"> {{$finding->recommendation}}</div> </td>
                <td width="10"> {{$finding->status}} </td>
                <td width="10"> {{$finding->severity}} </td>
                <td width="20"> {{$finding->created_at}} </td>
                <td width="20"> {{$finding->user->first_name}} {{$finding->user->last_name}} </td>
                <td width="20"> {{$finding->theresponsable->first_name}} {{$finding->theresponsable->last_name}} </td>
                <td width="20"> {{$finding->updated_at}} </td>
            </tr>
        @endforeach
        </tbody>

      </table>



</body>
</html>