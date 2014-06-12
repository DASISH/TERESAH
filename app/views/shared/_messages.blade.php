@if ($message = Session::get("error"))
    <div class="alert alert-danger">
        <button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>
        <p>{{ $message }}</p>
    </div>
    <!-- /alert.alert-danger -->
@endif

@if ($message = Session::get("info"))
    <div class="alert alert-info">
        <button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>
        <p>{{ $message }}</p>
    </div>
    <!-- /alert.alert-info -->
@endif

@if ($message = Session::get("success"))
    <div class="alert alert-success">
        <button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>
        <p>{{ $message }}</p>
    </div>
    <!-- /alert.alert-success -->
@endif

@if ($message = Session::get("warning"))
    <div class="alert alert-warning">
        <button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>
        <p>{{ $message }}</p>
    </div>
    <!-- /alert.alert-warning -->
@endif
