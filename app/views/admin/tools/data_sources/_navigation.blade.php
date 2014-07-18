<ul class="data-sources nav nav-tabs" role="tablist">
    @foreach ($dataSources as $dataSource)
        @include("admin.tools.data_sources._data_source", compact("dataSource"))
    @endforeach
</ul>
<!-- /data-sources.nav.nav-tabs -->
