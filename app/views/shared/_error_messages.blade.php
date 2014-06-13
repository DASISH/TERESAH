@if ($errors->any())
    <div class="alert alert-danger">
        @if (Session::get("simple_error_message"))
            {{ implode("", $errors->all("<p>:message</p>")) }}
        @else  
            <p>{{ Lang::get("views/shared/form.error.message") }}</p>

            <ul>
                {{ implode("", $errors->all("<li>:message</li>")) }}
            </ul>
        @endif
    </div>
    <!-- /alert.alert-danger -->
@endif
