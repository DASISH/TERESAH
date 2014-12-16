<a class="close-reveal-modal cancel" title="{{ Lang::get("views.shared.form.cancel") }}"> <span class="glyphicons remove_2"></span></a>

<div id="dialog">
    <div id="content" class="row dialog" role="main">
        <div class="small-12 medium-10 columns small-centered">
            @include("shared._messages")
            @yield("content")
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </div>
</div>
<!-- /content.row -->
