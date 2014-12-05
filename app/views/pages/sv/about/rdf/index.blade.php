@extends("layouts.default")

@section("content")
    <section class="row">
        <div class="small-10 columns small-centered">
            <h1>RDF Format</h1>

            <p>TERESAH erbjuder full export av verktygens metadata vi RDF</p>

            <h2>Informationskällor</h2>

            <p>Ett verktyg kan ha flera informationskällor för sin metadata. Dessa exporteras i följande dokument.</p>

            <dl>
                <dt>Informationskällor</dt>
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

            <h2>Datatyper</h2>

            <p>Beskriver tillgängliga datatyper och mappning och externa rdf-vokabulär.</p>

            <dl>
                <dt>Datatyper</dt>
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

            <h2>Verktyg</h2>

            <p>Lista över identifierare och länk till den fulla rdf-representationen för varje verktyg.</p>

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
