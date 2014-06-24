@include("shared._head")

<body>
    @include("shared._header")

    <div id="wrap">
        <div class="container">
            @include("shared._messages")
            @yield("breadcrumb")
            @yield("content")
        </div>
        <!-- /container -->

        <div id="push"></div>
    </div>
    <!-- /wrap -->

    @include("shared._footer")
</body>

</html>
