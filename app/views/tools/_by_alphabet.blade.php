<div class="btn-group">
  @foreach ($caracters as $c)
  <a type="button" class="btn btn-default" href="{{ URL::to("/tools/by-alphabets/" . $c["caracter"]) }}">{{ $c["caracter"] }}</a>
  @endforeach
</div>