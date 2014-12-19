@extends("layouts.default")

@section("content")
    @foreach ($content as $index => $section)
        <section class="row">
            <div class="small-12 medium-10 columns small-centered">
                {{ $section }}
            </div>
            <!-- /small-12.medium-10.columns.small-centered -->
        </section>
        <!-- /row -->
    @endforeach
@stop
