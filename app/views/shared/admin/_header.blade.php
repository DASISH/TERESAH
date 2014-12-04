<header id="header" role="banner">
    <div class="alert-box warning" data-alert>
        <p><strong>{{ Lang::get("views.shared.messages.admin.warning.highlight") }}</strong> {{ Lang::get("views.shared.messages.admin.warning.message") }}</p>

        <a href="#" class="close" title="{{ Lang::get("views.shared.messages.close") }}">&times;</a>
    </div>
    <!-- /alert-box.warning -->

    @include("shared.admin._navigation")

    <section id="master-head">
        @yield("breadcrumb")
        @yield("master-head")
    </section>
    <!-- /master-head -->
</header>
<!-- /header -->
