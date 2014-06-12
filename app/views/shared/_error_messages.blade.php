@if ($errors->any())
    <div class="alert alert-danger">
        <p>{{ Lang::get("views/shared/form.error.message") }}</p>

        <ul>
            {{ implode("", $errors->all("<li>:message</li>")) }}
        </ul>
    </div>
    <!-- /alert.alert-danger -->
@endif
