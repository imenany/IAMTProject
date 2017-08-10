<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Documents d'entrée   </title>
    <link rel="stylesheet" href="{{ ltrim(elixir('css/ROBS.css'), '/') }}" />
</head>
<body>

<table>

    <tr>
        <td width="26" class="noborder"></td>
        <td colspan="8" rowspan="2" class="noborder">
            <img src="{{ ltrim(elixir('img/viattechlogo.png'), '/') }}" width='200px' alt="placeholder+image" >
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th width="26" class="noborder"></th>
            <th width="40" colspan="1" class="border">Etat d'évaluation</th>
            <th width="80" colspan="4" class="border">Signification du code couleur</th>
            <th width="26" class="noborder"></th>
            <th width="36" class="noborder"> </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color1 border"></td>
            <td colspan="4"  class="border" height="25">Document analysé mais il n'y a pas d'observation ou des observations sont en cours de préparation   </td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color2 border"></td>
            <td colspan="4"  class="border" height="25">Document pas examiné au stade actuel ou en cours d'examination</td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color3 border"></td>
            <td colspan="4"  class="border" height="25">Le document doit être revu, n'est pas conforme aux normes CENELEC ou peut contenir des points bloquants </td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color4 border"></td>
            <td colspan="4"  class="border" height="25">Document analysé, en attente de justifications, quelques points majeurs à adresser, quelques changements de fond à apporter </td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
            <td class="color5 border"></td>
            <td colspan="4"  class="border" height="25">Quelques observations mineures  </td>
            <td width="36" class="noborder"> </td>
        </tr>
        <tr>
            <td width="26" class="noborder"></td>
                <td class="color6 border"></td>
            <td colspan="4" class="border" height="25">Plus d'observation ou le document ne nécessite pas d'examen particulier </td>
            <td width="36" class="noborder"> </td>
        </tr>
    </tbody>
</table>

    
<table >
  <thead>
    <tr>
            <th width="26" class="noborder"></th>

        <th colspan=2 class="border">@lang('strings.title')</th>
        <th class="border">@lang('strings.phase')</th>
        <th class="border">@lang('strings.version')</th>
        <th class="border">@lang('strings.status')</th>
        <th width="36" class="noborder"> </th>
    </tr>
    </thead>
  <tbody>
    @foreach($baselines as $baseline)
        @foreach($baseline->documents as $doc)
        <tr class="{!! ($doc->valid == 0) ? 'active' : '' !!}">
            <td width="26" class="noborder"></td>

            <td colspan=2  class="border">{{$doc->title}}</td>
            <td width="35" class="border">@if($doc->phase){{$doc->normesphase->name}}@endif</td>
            <td width="25" class="border">{{$doc->version}}</td>
            @if($doc->evaluation->id == 1)
                <td width="20" class="color1 border"></td>
            @elseif($doc->evaluation->id == 2)
                <td width="20" class="color2 border"></td>
            @elseif($doc->evaluation->id == 3)
                <td width="20" class="color3 border"></td>
            @elseif($doc->evaluation->id == 4)
                <td width="20" class="color4 border"></td>
            @elseif($doc->evaluation->id == 5)
                <td width="20" class="color5 border"></td>
            @elseif($doc->evaluation->id == 6)
                <td width="20" class="color6 border"></td>
            @endif
            <td width="36" class="noborder"> </td>
        </tr>
        @endforeach
    @endforeach
  </tbody>
</table>


</body>
</html>
