{{ Form::open(array("action" => "ToolsController@search", "method" => "get", "class" => "navbar-form navbar-right hidden-sm")) }}
    <div class="form-group">
        <input type="text" id="quicksearch" placeholder="{{ Lang::get("views/pages/navigation.search.placeholder") }}" name="query" class="form-control input-sm typeahead">
    </div>

    <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span></button>
{{ Form::close() }}
<!-- /navbar-form.navbar-right.hidden-sm -->
