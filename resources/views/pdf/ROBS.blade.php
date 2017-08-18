<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="{{ ltrim(elixir('css/ROBS_pdf.css'), '/') }}" />
</head>
<body>


<script type="text/php">
	if(isset($pdf)) { 
	    $pdf->page_script('
	        if ($PAGE_COUNT > 1) {
	            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
	            $size = 6;
	            $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT ;
		        $x = $pdf->get_width() - 100;
		        $y = $pdf->get_height()  - 35;
	            $pdf->text($x, $y, $pageText, $font, $size);
	        } 
	    ');
	};

	if (isset($pdf)) {
        $size = 6;
        $text = date('l jS \of F Y h:i:s A e');
        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $x = $pdf->get_width() - 240;
        $y = $pdf->get_height() - 35;

        $pdf->page_text($x, $y, $text, $font, $size);
    }
</script>


<div align="right" class="logo">
	<img src="{{ ltrim(elixir('img/viattechlogo.png'), '/') }}" alt="placeholder+image" >
	<br><span class="slogan">Your Partner for Quality and Safety Assurance Management</span>
</div>
<h3 align="center">
	Projet : {{$findings->first()->first()->document->baseline->project->title}} - Findings ISA
</h3>
<table align="center">
    <thead>
      <tr>
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
      </tr> 
    </thead>
    <tbody>
    @foreach($findings as $element)

        <tr>
            <td colspan="11" class='black border' align="center">{{$element->first()->finding}}</td>
        </tr>
        @foreach($element as $finding)
            <tr>
                <td valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->finding}} </td>
                <td valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->cycle}} </td>
                <td  valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> 
                    @if(strpos($finding->cycle, 'O') !== false)
                        <div id="description{{$finding->id}}" data-html="{{$finding->description}}"> {{$finding->description}}</div>
                    @else 
                        <div id="description{{$finding->id}}" data-html="{{$finding->response}}"> {{$finding->response}}</div>
                    @endif
                </td>
                <td valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->document->title}} </td>
                <td  valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> <div id="recommendation{{$finding->id}}" data-html="{{$finding->recommendation}}"> {{$finding->recommendation}}</div> </td>
                <td valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->status}} </td>
                <td valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->severity}} </td>
                <td  valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->created_at}} </td>
                <td  valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->user->first_name}} {{$finding->user->last_name}} </td>
                <td  valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->theresponsable->first_name}} {{$finding->theresponsable->last_name}} </td>
                <td  valign="top" class="border {!! ( strpos($finding->cycle, 'R') !== false) ? 'O' : 'R' !!}"> {{$finding->updated_at}} </td>

            </tr>
        @endforeach

        @endforeach
        </tbody>

</table>

<h3 align="center">
    Projet : {{$findings->first()->first()->document->baseline->project->title}} - Documents </h3>

<table align="center" class="print-friendly">
    <thead>
        <tr>
            <th colspan="1" class="border">Etat d'évaluation</th>
            <th colspan="4" class="border">Signification du code couleur</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="color1 border"></td>
            <td colspan="4"  class="border" height="25">Document analysé mais il n'y a pas d'observation ou des observations sont en cours de préparation   </td>
        </tr>
        <tr>
            <td class="color2 border"></td>
            <td colspan="4"  class="border" height="25">Document pas examiné au stade actuel ou en cours d'examination</td>
        </tr>
        <tr>
            <td class="color3 border"></td>
            <td colspan="4"  class="border" height="25">Le document doit être revu, n'est pas conforme aux normes CENELEC ou peut contenir des points bloquants </td>
        </tr>
        <tr>
            <td class="color4 border"></td>
            <td colspan="4"  class="border" height="25">Document analysé, en attente de justifications, quelques points majeurs à adresser, quelques changements de fond à apporter </td>
        </tr>
        <tr>
            <td class="color5 border"></td>
            <td colspan="4"  class="border" height="25">Quelques observations mineures  </td>
        </tr>
        <tr>
            <td class="color6 border"></td>
            <td colspan="4" class="border" height="25">Plus d'observation ou le document ne nécessite pas d'examen particulier </td>
        </tr>
    </tbody>
</table>

<h3 align="center">
    Projet : {{$findings->first()->first()->document->baseline->project->title}} - Documents </h3>

<table align="center">
  <thead>
    <tr>
        <th colspan=2 class="border">@lang('strings.title')</th>
        <th class="border">@lang('strings.phase')</th>
        <th class="border">@lang('strings.version')</th>
        <th class="border">@lang('strings.status')</th>
    </tr>
    </thead>
  <tbody>
    @foreach($baselines as $baseline)
        @foreach($baseline->documents as $doc)
        <tr class="{!! ($doc->valid == 0) ? 'active' : '' !!}">

            <td colspan=2  class="border">{{$doc->title}}</td>
            <td  class="border">@if($doc->phase){{$doc->normesphase->name}}@endif</td>
            <td class="border">{{$doc->version}}</td>
            @if($doc->evaluation->id == 1)
                <td class="color1 border"></td>
            @elseif($doc->evaluation->id == 2)
                <td  class="color2 border"></td>
            @elseif($doc->evaluation->id == 3)
                <td class="color3 border"></td>
            @elseif($doc->evaluation->id == 4)
                <td class="color4 border"></td>
            @elseif($doc->evaluation->id == 5)
                <td class="color5 border"></td>
            @elseif($doc->evaluation->id == 6)
                <td class="color6 border"></td>
            @endif
        </tr>
        @endforeach
    @endforeach
  </tbody>
</table>

<h3 align="center">
    Projet : {{$findings->first()->first()->document->baseline->project->title}} - Missing Documents </h3>

<table align="center">
  <thead>
    <tr>
        <th colspan=2 class="border">@lang('strings.title')</th>
        <th class="border">@lang('strings.phase')</th>
        <th colspan=2  class="border">@lang('strings.responsable')</th>
        <th class="noborder"> </th>

    </tr>
    </thead>
  <tbody>
        @foreach($Documents as $document)
        <tr >
            <td colspan=2  class="border"> {{$document->title}} </td>
            <td class="border"> {{$document->normephase->name}} </td>
            <td colspan=2 class="border"> {{$document->theresponsable->first_name}} {{$document->theresponsable->last_name}}</td>
            <td class="noborder"> </td>
        </tr>
        @endforeach
  </tbody>
</table>


</body>
</html>