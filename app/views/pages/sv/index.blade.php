@extends("layouts.default")

@section("content")
    <div class="jumbotron">
        <h1>Wälkommen till TERESAH</h1>

        <p>TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.</p>
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
