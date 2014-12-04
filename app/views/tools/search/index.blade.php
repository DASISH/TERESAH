@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.shared.navigation.search.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-6 columns">
            <h1>{{ Lang::get("views.tools.search.index.heading") }}</h1>

            <p>{{ Lang::get("views.tools.index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>
        </div>
        <!-- /small-6.columns -->

        <div class="small-6 columns">
            {{ Form::open(array("action" => "ToolsController@search", "method" => "get", "class" => "row")) }}
                @foreach ($facetList as $facet)
                    @if (Input::has($facet->slug))
                        {{ Form::hidden($facet->slug, Input::get($facet->slug)) }}
                    @endif
                @endforeach

                <div class="small-12 columns">
                    <div class="search">
                        {{ Form::text("query", $query, array("placeholder" => Lang::get("views.tools.search.form.search.placeholder"))) }}
                    </div>
                    <!-- /search -->
                </div>
                <!-- /small-12.columns -->
            {{ Form::close() }}
            <!-- /row -->
        </div>
        <!-- /small-6.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <dl class="accordion" data-accordion>
                <dd class="accordion-navigation active">
                    <a href="#filter">Filter Search Results</a>

                    <div id="filter" class="content active">
                        <ul class="small-block-grid-6">
                            @foreach ($facetList as $facet)
                                @if (count($facet->values) > 0)
                                    <li>
                                        <h2{{empty($facet->description) ? '' : ' title="'.$facet->description.'"'}}>{{ $facet->label }}</h2>

                                      <p class="hide">{{$facet->description}}</p>

                                      <ul class="no-bullet">
                                          @foreach ($facet->values as $value)
                                              @if (ArgumentsHelper::keyValueActive($facet->slug, $value->slug))
                                                  <li class="selected"><span class="label round">{{ $value->total }}</span> {{ link_to_route("tools.search", $value->value, ArgumentsHelper::removeKeyValue($facet->slug, $value->slug), array("rel" => "nofollow")) }}</li>
                                              @else
                                                  <li><span class="label round">{{ $value->total }}</span> {{ link_to_route("tools.search", $value->value, ArgumentsHelper::addKeyValue($facet->slug, $value->slug), array("rel" => "nofollow")) }}</li>
                                              @endif
                                          @endforeach

                                          @if ($facet->values->getTotal() > $facet->values->getPerPage())
                                              <li>{{ link_to_route("tools.search", Lang::get("views.tools.search.index.list_more", array("num" => 5)), ArgumentsHelper::setValues(array($facet->slug."-limit" => ($facet->values->getPerPage() + 5))), array("rel" => "nofollow")) }}</li>
                                          @endif
                                      </ul>
                                      <!-- /no-bullet -->
                                  </li>
                                @endif
                            @endforeach
                        </ul>
                        <!-- /small-block-grid-6 -->
                    </div>
                    <!-- /filter.content.active -->
                </dd>
                <!-- /accordion-navigation.active -->
            </dl>
            <!-- /accordion -->

            @if (count($tools) > 0)
                <ul class="small-block-grid-4">
                    @foreach ($tools as $tool)
                        @include("tools._tool", array($tool, "type" => "block-grid"))
                    @endforeach
                </ul>
                <!-- /small-block-grid-4 -->

                {{ $tools->appends(Input::all())->links() }}
            @else
                {{ Lang::get("views.tools.index.not_found") }}
            @endif
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
