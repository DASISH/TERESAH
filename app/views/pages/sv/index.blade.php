@extends("layouts.default")

@section("content")
    <div class="jumbotron">
        <h1>Välkommen till TERESAH</h1>

        <p>TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) är ett tvärvetenskapligt verktygsregister riktar sig till forskare inom samhällsvetenskap och humaniora (SSH). Syftet är att ge en auktoritativ notering av mjukvaruverktyg som för närvarande används i dessa områden, och att låta sina användare beskriva metoder och tillämpningar som verktygen möjliggör.</p>
    </div>
    <!-- /jumbotron -->

    <div id="cloud">
        <p>Laddar molnet...</p>
    </div>
    <!-- /cloud -->

    <!-- Initialize cloud -->
    <script type="text/javascript">
        // TODO: Replace the test data
        $.getJSON( "datacloud.json", function( data ) {
            $("#cloud").empty().jQCloud(data);
        });
    </script>
@stop
