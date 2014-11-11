<ul class="inline-list">
    @foreach ($caracters as $character)
        @if($selected === $character)
            <li>{{ $character }}</li>
        @else
            <li><a href="{{ URL::to("/tools/by-alphabets/" . $character) }}" title="{{ $character }}">{{ $character }}</a></li>
        @endif
    @endforeach
</ul>
<!-- /inline-list -->
