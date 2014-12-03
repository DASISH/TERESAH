@include("shared._head")

<body>
    @include("shared.admin._header")

    <main id="content" role="main">
        @include("shared._messages")
        @yield("content")
    </main>
    <!-- /content -->

    @include("shared._footer")
</body>

</html>
