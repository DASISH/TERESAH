<dd{{ Active::path(ltrim(parse_url(URL::route("tools.data-sources.show", array($tool->slug, $dataSource->slug)))["path"], "/"), " class=\"active\"") }}>
    <a href="{{ URL::route("tools.data-sources.show", array($tool->slug, $dataSource->slug)) }}" title="{{{ $dataSource->name }}}">{{{ $dataSource->name }}} <span class="source">{{{ $dataSource->source }}}</span></a>
</dd>
