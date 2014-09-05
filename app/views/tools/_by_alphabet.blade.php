<div class="btn-group">
  @foreach ($caracters as $c)
    @if($selected === $c)
        <span class="btn btn-primary">{{ $c }}</span>
    @else
        <a type="button" class="btn btn-default" href="{{ URL::to("/tools/by-alphabets/" . $c) }}">{{ $c }}</a>
    @endif
  @endforeach
</div>