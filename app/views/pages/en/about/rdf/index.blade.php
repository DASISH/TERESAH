@extends("layouts.default")

@section("content")
    <section class="row">
        <div class="small-10 columns small-centered">
            <h1>RDF Representations</h1>

            <p>TERESAH suports full export of all tool metadata via RDF</p>

            <h2>Datasources</h2>

            <p>A tool can have several sources for the metadata. These sources are described in this export.</p>

            <dl>
                <dt>Datasources</dt>
                @if(in_array("XML", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datasources", "RDF/XML", "rdfxml") }}</dd>
                @endif

                @if(in_array("Turtle", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datasources", "RDF/Turtle", "turtle") }}</dd>
                @endif

                @if(in_array("JsonLD", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datasources", "RDF/JsonLD", "jsonld") }}</dd>
                @endif

                @if(in_array("nTriples", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datasources", "RDF/N-Triples", "ntriples") }}</dd>
                @endif
            </dl>

            <h2>Datatypes</h2>

            <p>The list of datatypes used for the facets. These are in most vases mapped a common property in a external rdf-vocabulary.</p>

            <dl>
                <dt>Datatypes</dt>
                @if(in_array("XML", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datatypes", "RDF/XML", "rdfxml") }}</dd>
                @endif

                @if(in_array("Turtle", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datatypes", "RDF/Turtle", "turtle") }}</dd>
                @endif

                @if(in_array("JsonLD", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datatypes", "RDF/JsonLD", "jsonld") }}</dd>
                @endif

                @if(in_array("nTriples", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@datatypes", "RDF/N-Triples", "ntriples") }}</dd>
                @endif
            </dl>

            <h2>Tools</h2>

            <p>List of name and indetifiers of tools in this registry and source link to a complete rdf presentaitons of the tool.</p>

            <dl>
                <dt>Tool index</dt>
                @if(in_array("XML", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@tools", "RDF/XML", "rdfxml") }}</dd>
                @endif

                @if(in_array("Turtle", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@tools", "RDF/Turtle", "turtle") }}</dd>
                @endif

                @if(in_array("JsonLD", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@tools", "RDF/JsonLD", "jsonld") }}</dd>
                @endif

                @if(in_array("nTriples", Config::get("teresah.tool_rdf_formats")))
                <dd>{{ link_to_action("RdfController@tools", "RDF/N-Triples", "ntriples") }}</dd>
                @endif
            </dl>
        </div>
        <!-- /small-10.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
