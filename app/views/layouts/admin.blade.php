@include("shared._head")

<body>
    @include("shared.admin._header")

    <main id="content" class="container" role="main">
        @include("shared._messages")
        @yield("breadcrumb")
        @yield("content")
    </main>
    <!-- /content.container -->

    @include("shared._footer")
</body>

</html>
