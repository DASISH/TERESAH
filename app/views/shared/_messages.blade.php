@if (Session::has("error") || Session::has("info") || Session::has("success") || Session::has("warning"))
    <div class="row">
        <div class="small-12 columns">
            @if ($message = Session::get("error"))
                <div class="alert-box alert" data-alert>
                    {{ $message }}
                    <a href="#" class="close">&times;</a>
                </div>
                <!-- /alert-box.alert -->
            @endif

            @if ($message = Session::get("info"))
                <div class="alert-box info" data-alert>
                    {{ $message }}
                    <a href="#" class="close">&times;</a>
                </div>
                <!-- /alert-box.info -->
            @endif

            @if ($message = Session::get("success"))
                <div class="alert-box success" data-alert>
                    {{ $message }}
                    <a href="#" class="close">&times;</a>
                </div>
                <!-- /alert-box.success -->
            @endif

            @if ($message = Session::get("warning"))
                <div class="alert-box warning" data-alert>
                    {{ $message }}
                    <a href="#" class="close">&times;</a>
                </div>
                <!-- /alert-box.warning -->
            @endif
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@endif
