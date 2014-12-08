@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.shared.navigation.browse.all.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 medium-7 columns">
            <h1>{{ Lang::get("views.tools.index.heading") }}</h1>

            <p>{{ Lang::get("views.tools.index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>
        </div>
        <!-- /small-12.medium-7.columns -->

        <div class="small-12 medium-5 columns">
            <ul class="inline-list">
                @foreach (array_merge(range(0, 9), range("a", "z")) as $character)
                    <li><a href="{{ URL::to("/tools/by-alphabets/" . $character) }}" title="{{ strtoupper($character) }}">{{ strtoupper($character) }}</a></li>
                @endforeach
            </ul>
            <!-- /inline-list -->
        </div>
        <!-- /small-12.medium-5.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <h1 class="hide">{{ Lang::get("views.tools.index.heading") }}</h1>

            <ul class="small-block-grid-1 medium-block-grid-4">
                @foreach ($tools as $tool)
                    @include("tools._tool", array($tool, "type" => "block-grid"))
                @endforeach
            </ul>
            <!-- /small-block-grid-1.medium-block-grid-4 -->

            {{ $tools->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
