<footer id="footer">
    <p><a href="{{ Lang::get("views/pages/navigation.dasish.href") }}" title="{{ Lang::get("views/pages/navigation.dasish.title") }}">{{ image_tag("dasish_header_logo.png", array("alt" => Lang::get("views/pages/navigation.dasish.title"))) }}</a></p>
</footer>

@if(isset($_ENV["ADDTHIS"]))
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid={{ $_ENV["ADDTHIS"] }}"></script>
@endif