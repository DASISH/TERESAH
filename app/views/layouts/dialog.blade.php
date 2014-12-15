@include("shared._head")

<body class="dialog">
    <header id="header" role="banner">
        <h1 id="logo"><a href="/" title="TERESAH">{{ image_tag("teresah_logo_alternative.png", array("alt" => "TERESAH")) }}</a></h1>

        @if (URL::previous())
        <a href="{{ URL::previous() }}" class="cancel" title="{{ Lang::get("views.shared.form.cancel") }}">{{ Lang::get("views.shared.form.cancel") }} <span class="glyphicons remove_2"></span></a>
        @else
        <a href="{{ url("/") }}" class="cancel" title="{{ Lang::get("views.shared.form.cancel") }}">{{ Lang::get("views.shared.form.cancel") }} <span class="glyphicons remove_2"></span></a>
        @endif
    </header>
    <!-- /header -->

    <main id="content" class="row" role="main">
        <div class="small-12 medium-10 columns small-centered">
            @include("shared._messages")
            @yield("content")
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </main>
    <!-- /content.row -->
</body>

</html>
