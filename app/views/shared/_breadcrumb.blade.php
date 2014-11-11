@if (isset($breadcrumb) && is_array($breadcrumb))
    <div class="row">
        <ul class="breadcrumbs small-12 columns">
            @foreach ($breadcrumb as $index => $page)
                @if ($index == count($breadcrumb) - 1)
                    <li class="current">{{ $page }}</li>
                @else
                    <li>{{ $page }}</li>
                @endif
            @endforeach
        </ul>
        <!-- /breadcrumbs.small-12.columns -->
    </div>
    <!-- /row -->
@endif
