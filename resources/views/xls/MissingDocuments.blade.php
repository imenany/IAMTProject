<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Documents Manquants</title>
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
    
<table >
  <thead>
    <tr>
        <th width="26" class="noborder"></th>
        <th colspan=2 class="border">@lang('strings.title')</th>
        <th class="border">@lang('strings.phase')</th>
        <th colspan=2 width="46" class="border">@lang('strings.responsable')</th>
        <th width="36" class="noborder"> </th>
        <th class="noborder"> </th>
        <th class="noborder"> </th>
    </tr>
    </thead>
  <tbody>
        @foreach($Documents as $document)
        <tr >
            <td width="26" class="noborder"></td>
            <td colspan=2 width="46" class="border"> {{$document->title}} </td>
            <td width="46" class="border"> {{$document->normephase->name}} </td>
            <td colspan=2 width="46" class="border"> {{$document->theresponsable->first_name}} {{$document->theresponsable->last_name}}</td>
            <td width="36" class="noborder"> </td>
            <td class="noborder"> </td>
            <td class="noborder"> </td>
        </tr>
        @endforeach
  </tbody>
</table>


</body>
</html>
