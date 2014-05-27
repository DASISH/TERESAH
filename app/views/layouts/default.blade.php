@include("shared._head")

<body>
    @include("shared._header")

    <div id="wrap">
        <div class="container">
            @yield("content")
        </div>
        <div id="push"></div>
    </div>

    @include("shared._footer")
</body>

</html>
