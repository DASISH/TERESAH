<li{{ Active::path(ltrim(parse_url(URL::route("tools.data-sources.show", array($tool->slug, $dataSource->id)))["path"], "/"), " class=\"active\"") }}>
    <a href="{{ URL::route("tools.data-sources.show", array($tool->slug, $dataSource->id)) }}" title="{{{ $dataSource->name }}}">{{{ $dataSource->name }}} <span class="source">{{{ $dataSource->source }}}</span></a>
</li>