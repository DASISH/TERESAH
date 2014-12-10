@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    $title
)))

@section("content")
    <section class="row">
        <div class="small-12 medium-10 columns small-centered">
            <h1>{{ $title }}</h1>
            {{ $content }}
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
