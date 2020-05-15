<!DOCTYPE html>
<html lang="{{ \App\Helpers\App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="language" content="{{ \App\Helpers\App::getLocale() }}"/>
    <title>{{ MetaTag::get('title') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::twitterCard() !!}

    <link rel="stylesheet" href="{{ url('/') }}/themes/default/css/style.min.css">
    <link rel="stylesheet" id="colorbox-theme11-css" href="{{ url('/') }}/themes/default/vendor/css/colorbox.css"
          type="text/css" media="screen"/>
    <script type="text/javascript" src="{{ url('/') }}/themes/default/vendor/js/jquery.colorbox-min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script>
        /* <![CDATA[ */
        var jQueryColorboxSettingsArray = {
            "jQueryColorboxVersion": "4.6.1",
            "colorboxInline": "false",
            "colorboxIframe": "false",
            "colorboxGroupId": "",
            "colorboxTitle": "",
            "colorboxWidth": "false",
            "colorboxHeight": "false",
            "colorboxMaxWidth": "false",
            "colorboxMaxHeight": "false",
            "colorboxSlideshow": "false",
            "colorboxSlideshowAuto": "false",
            "colorboxScalePhotos": "false",
            "colorboxPreloading": "false",
            "colorboxOverlayClose": "false",
            "colorboxLoop": "true",
            "colorboxEscKey": "true",
            "colorboxArrowKey": "true",
            "colorboxScrolling": "true",
            "colorboxOpacity": "0.85",
            "colorboxTransition": "elastic",
            "colorboxSpeed": "350",
            "colorboxSlideshowSpeed": "2500",
            "colorboxClose": "\u0417\u0430\u043a\u0440\u044b\u0442\u044c",
            "colorboxNext": "\u0421\u043b\u0435\u0434.",
            "colorboxPrevious": "\u041f\u0440\u0435\u0434.",
            "colorboxSlideshowStart": "\u0417\u0430\u043f\u0443\u0441\u0442\u0438\u0442\u044c \u0441\u043b\u0430\u0439\u0434\u0448\u043e\u0443",
            "colorboxSlideshowStop": "\u041e\u0441\u0442\u0430\u043d\u043e\u0432\u0438\u0442\u044c \u0441\u043b\u0430\u0439\u0434\u0448\u043e\u0443",
            "colorboxCurrent": "{current} \u0438\u0437 {total} \u0438\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u0439",
            "colorboxXhrError": "This content failed to load.",
            "colorboxImgError": "This image failed to load.",
            "colorboxImageMaxWidth": "false",
            "colorboxImageMaxHeight": "false",
            "colorboxImageHeight": "false",
            "colorboxImageWidth": "false",
            "colorboxLinkHeight": "false",
            "colorboxLinkWidth": "false",
            "colorboxInitialHeight": "100",
            "colorboxInitialWidth": "300",
            "autoColorboxJavaScript": "",
            "autoHideFlash": "",
            "autoColorbox": "true",
            "autoColorboxGalleries": "",
            "addZoomOverlay": "",
            "useGoogleJQuery": "",
            "colorboxAddClassToLinks": ""
        };
        /* ]]> */

        jQuery.extend(jQuery.colorbox.settings, {
            current: "image {current} of {total}",
            previous: "previous",
            next: "next",
            close: "close",
            xhrError: "Failed to load content.",
            imgError: "Failed to load image.",
            slideshowStart: "slide show start",
            slideshowStop: "slide show stop"
        });
        $(document).ready(function () {
            //Examples of how to assign the Colorbox event to elements
            $('a[href$=".gif"], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".bmp"]').colorbox({rel: 'cboxElement'});

            //Example of preserving a JavaScript event for inline calls.
            $("#click").click(function () {
                $('#click').css({
                    "background-color": "#f00",
                    "color": "#fff",
                    "cursor": "inherit"
                }).text("Open this window again and this message will still be here.");
                return false;
            });
        });
    </script>

</head>

<body class="home blog custom-background single-author">


<div id="page" class="hfeed site">

    <div id="head-container">

        <div class="row">

            <header id="masthead" class="site-header row twelve columns" role="banner">
                @include('client.themes.default.layout.partials.header')
            </header>

            <div id="main" class="row">

                <div id="primary" class="site-content eight columns">
                    <div id="content" role="main">
                        @yield('content')
                    </div>
                </div>

                <div id="secondary" class="widget-area four columns" role="complementary">
                    @include('client.themes.default.layout.partials.sidebar')
                </div>

            </div>

            <footer id="colophon" class="site-footer" role="contentinfo">
                @include('client.themes.default.layout.partials.footer')
            </footer>
        </div>

    </div>
</div>
</body>
</html>