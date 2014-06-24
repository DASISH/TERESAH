@if (isset($breadcrumb) && is_array($breadcrumb))
    <ol class="breadcrumb">
        @foreach ($breadcrumb as $index => $page)
            @if ($index == count($breadcrumb) - 1)
                <li class="active">{{ $page }}</li>
            @else
                <li>{{ $page }}</li>
            @endif
        @endforeach
    </ol>
    <!-- /breadcrumb -->
@endif
