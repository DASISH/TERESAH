@include("shared._head")

<body class="dialog">
    <header id="header" role="banner">
        <h1 id="logo"><a href="/" title="TERESAH">{{ image_tag("teresah_logo_alternative.png", array("alt" => "TERESAH")) }}</a></h1>

        <a href="#" class="cancel" title="Cancel">Cancel <span class="glyphicons remove_2"></span></a>
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
