<div class="row">
    <div class="small-12 columns">
        <div class="symbol">
            <abbr title="{{{ $tool->name }}}">{{{ $tool->abbreviation }}}</abbr>
        </div>
        <!-- /symbol -->

        <h1>{{{ $tool->name }}} <a href="{{ URL::route("admin.tools.edit", array("id" => $tool->id)) }}" class="button right" title="{{ Lang::get("views/pages/navigation.admin.tools.edit.title") }}" role="button"><span class="glyphicons pencil"></span> {{ Lang::get("views/pages/navigation.admin.tools.edit.name") }}</a></h1>
    </div>
    <!-- /small-12.columns -->
</div>
<!-- /row -->
