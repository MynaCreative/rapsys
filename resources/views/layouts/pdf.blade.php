<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
</head>
<body>
    <div class="page">
        @yield('content')
        @if (View::hasSection('showPage') && View::getSection('showPage'))
            <script type="text/php">
                // $canvas = $pdf->getCanvas();
                // $pageWidth = $canvas->get_width();
                // $canvas->page_text($pageWidth / 2, 810, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
                if (isset($pdf)) {
                    $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
                    $size = 10;
                    $font = $fontMetrics->getFont("Calibri");
                    $width = $fontMetrics->get_text_width($text, $font, $size) / 3.5;
                    $x = ($pdf->get_width() - $width) / 2;
                    $y = $pdf->get_height() - 35;
                    $pdf->page_text($x, $y, $text, $font, $size);
                }
            </script>
        @endif
    </div>
</body>
</html>
