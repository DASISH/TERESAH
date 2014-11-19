@if (isset($type) && $type == "block-grid")
<li>
    @endif
    <article class="tool align row" itemscope itemtype="http://schema.org/SoftwareApplication">
        <div class="small-3 columns">
            <a href="{{ URL::route("tools.show", $tool->slug) }}" class="symbol" title="{{{ $tool->name }}}"><abbr title="{{{ $tool->name }}}">{{{ $tool->abbreviation }}}</abbr></a>
        </div>
        <!-- /small-3.columns -->

        <div class="small-9 columns">
            <h1 itemprop="name"><a href="{{ URL::route("tools.show", $tool->slug) }}" title="{{{ $tool->name }}}">{{{ $tool->name }}}</a></h1>

            <p>about {{{ $tool->updated_at->diffForHumans() }}}</p>
        </div>
        <!-- /small-9.columns -->
    </article>
    <!-- /tool.align.row -->
    @if (isset($type) && $type == "block-grid")
</li>
@endif
