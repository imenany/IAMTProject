<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Findings_ISA</title>
    <link rel="stylesheet" href="{{ ltrim(elixir('css/ROBS.css'), '/') }}" />
</head>
<body>



{{--<div align="right" class="logo">
    <td></td><td></td><img src="{{ ltrim(elixir('img/viattechlogo.png'), '/') }}" alt="placeholder+image" >
    <td></td><br><span class="slogan">Your Partner for Quality and Safety Assurance Management</span>

</div>
<h3 align="center">
       Projet : {{$findings->first()->first()->document->baseline->project->title}} - Findings ISA {{date('l jS \of F Y h:i:s A e')}}
</h3>
--}}

<table>
    <tr>
        <td width="26" class="noborder"></td>
        <td colspan="12" rowspan="2" class="noborder">
            <img src="{{ ltrim(elixir('img/viattechlogo.png'), '/') }}" width='200px' alt="placeholder+image" >
        </td>
    </tr>
</table>

<table>
    <tbody>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color4 border"></td>
            <td colspan="10" class="border" height="25">Demande de réponse</td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color1 border"></td>
            <td colspan="10"  class="border" height="25">Point fermé</td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color5 border"></td>
            <td colspan="10"  class="border" height="25">En attente de documents</td>
            <td width="36" class="noborder"> </td>
        </tr>
    </tbody>
</table>


  <table class="">
    <thead>
      <tr>
        <th width="26" class="noborder"></th>
        <th class="border">@lang('strings.finding')</th>
        <th class="border">@lang('strings.cycle')</th>
        <th class="border">@lang('strings.description')</th>
        <th class="border">@lang('strings.relatedDoc')</th>
        <th class="border">@lang('strings.recommendation')</th>
        <th class="border">@lang('strings.status')</th>
        <th class="border">@lang('strings.severity')</th>
        <th class="border">@lang('strings.createdat')</th>
        <th class="border">@lang('strings.createdby')</th>
        <th class="border">@lang('strings.responsable')</th>
        <th class="border">@lang('strings.updatedat')</th>
        <th width="36" class="noborder"></th>
      </tr> 
    </thead>
    <tbody>
    @foreach($findings as $element)

        <tr>
            <td width="26" class="noborder"></td>
            <td colspan="11" class='black border' align="center">{{$element->first()->finding}}</td>
            <td width="36" class="noborder"></td>
        </tr>
        @foreach($element as $finding)
            <tr>
                <td width="26" class="noborder"></td>
                <td width="20" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->finding}} </td>
                <td width="8" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->cycle}} </td>
                <td width="30" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> 
                    @if(strpos($finding->cycle, 'O') !== false)
                        <div id="description{{$finding->id}}" data-html="{{$finding->description}}"> {{$finding->description}}</div>
                    @else 
                        <div id="description{{$finding->id}}" data-html="{{$finding->response}}"> {{$finding->response}}</div>
                    @endif
                </td>
                <td width="25" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->document->title}} </td>
                <td width="30" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> <div id="recommendation{{$finding->id}}" data-html="{{$finding->recommendation}}"> {{$finding->recommendation}}</div> </td>
                <td width="10" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->status}} </td>
                <td width="10" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->severity}} </td>
                <td width="20" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->created_at}} </td>
                <td width="20" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->user->first_name}} {{$finding->user->last_name}} </td>
                <td width="20" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->theresponsable->first_name}} {{$finding->theresponsable->last_name}} </td>
                <td width="20" valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->updated_at}} </td>
                <td width="36" class="noborder"> </td>

            </tr>
        @endforeach

        @endforeach
        </tbody>

        </table>


</body>
</html>
