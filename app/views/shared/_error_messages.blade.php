@if ($errors->any())
    <div class="alert-box alert" data-alert>
        @if (Session::get("simple_error_message"))
            {{ implode("", $errors->all(":message")) }}
        @else
            <p>{{ Lang::get("views.shared.form.error.message") }}</p>

            <ul>
                {{ implode("", $errors->all("<li>:message</li>")) }}
            </ul>
        @endif

        <a href="#" class="close">&times;</a>
    </div>
    <!-- /alert-box.alert -->
@endif
