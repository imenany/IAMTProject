<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="{{ ltrim(elixir('css/ROBS.css'), '/') }}" />
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
    @foreach($findings as $element)
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
        @foreach($element as $finding)
            <tr class="{!! ( strpos($finding->cycle, 'R') !== false) ? 'lightYellow' : '' !!}">
                <td> {{$finding->finding}} </td>
                <td> {{$finding->cycle}} </td>
                <td> 
                    @if(strpos($finding->cycle, 'O') !== false)
                        <div id="description{{$finding->id}}" data-html="{{$finding->description}}"> {{$finding->description}}</div>
                    @else 
                        <div id="description{{$finding->id}}" data-html="{{$finding->response}}"> {{$finding->response}}</div>
                    @endif
                </td>
                <td> {{$finding->document->title}} </td>
                <td> <div id="recommendation{{$finding->id}}" data-html="{{$finding->recommendation}}"> {{$finding->recommendation}}</div> </td>
                <td> {{$finding->status}} </td>
                <td> {{$finding->severity}} </td>
                <td> {{$finding->created_at}} </td>
                <td> {{$finding->user->first_name}} {{$finding->user->last_name}} </td>
                <td> {{$finding->theresponsable->first_name}} {{$finding->theresponsable->last_name}} </td>
                <td> {{$finding->updated_at}} </td>
            </tr>
        @endforeach
        </tbody>
      </table>
    @endforeach


</body>
</html>