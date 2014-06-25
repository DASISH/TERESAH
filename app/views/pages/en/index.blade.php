@extends("layouts.default")

@section("content")
    <div class="jumbotron">
        <h1>Welcome to TERESAH</h1>

        <p>TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.</p>
    </div>
    <!-- /jumbotron -->

    <div id="cloud">
        <p>Loading tool cloud, please wait...</p>
    </div>
    <!-- /cloud -->

    <!-- Initialize cloud -->
    <script type="text/javascript">
        // TODO: Replace the test data
        $("#cloud").empty().jQCloud([{"id":"13","text":"Annotation","weight":"25","link":"\/facet\/ToolType\/13"},{"id":"2","text":"Authoring interactive works","weight":"6","link":"\/facet\/ToolType\/2"},{"id":"15","text":"Bibliographic management","weight":"15","link":"\/facet\/ToolType\/15"},{"id":"32","text":"Bookmarking","weight":"7","link":"\/facet\/ToolType\/32"},{"id":"28","text":"Brainstorming","weight":"9","link":"\/facet\/ToolType\/28"},{"id":"5","text":"Cloud computing","weight":"10","link":"\/facet\/ToolType\/5"},{"id":"14","text":"Collaborative editing","weight":"6","link":"\/facet\/ToolType\/14"},{"id":"36","text":"Communication","weight":"14","link":"\/facet\/ToolType\/36"},{"id":"33","text":"Course management","weight":"4","link":"\/facet\/ToolType\/33"},{"id":"18","text":"Data analysis","weight":"31","link":"\/facet\/ToolType\/18"},{"id":"1","text":"Data collection","weight":"23","link":"\/facet\/ToolType\/1"},{"id":"24","text":"Data conversion","weight":"27","link":"\/facet\/ToolType\/24"},{"id":"25","text":"Data storage","weight":"9","link":"\/facet\/ToolType\/25"},{"id":"26","text":"Image collections","weight":"9","link":"\/facet\/ToolType\/26"},{"id":"22","text":"Image editing","weight":"19","link":"\/facet\/ToolType\/22"},{"id":"31","text":"Linguistic research","weight":"9","link":"\/facet\/ToolType\/31"},{"id":"3","text":"Linked data","weight":"5","link":"\/facet\/ToolType\/3"},{"id":"7","text":"Mapping","weight":"22","link":"\/facet\/ToolType\/7"},{"id":"6","text":"Organization","weight":"17","link":"\/facet\/ToolType\/6"},{"id":"12","text":"Publishing","weight":"26","link":"\/facet\/ToolType\/12"},{"id":"17","text":"Scholarly and social networking","weight":"20","link":"\/facet\/ToolType\/17"},{"id":"27","text":"Search","weight":"17","link":"\/facet\/ToolType\/27"},{"id":"35","text":"Semantic markup","weight":"10","link":"\/facet\/ToolType\/35"},{"id":"20","text":"Staying current","weight":"10","link":"\/facet\/ToolType\/20"},{"id":"29","text":"Task management","weight":"8","link":"\/facet\/ToolType\/29"},{"id":"4","text":"Text collections","weight":"15","link":"\/facet\/ToolType\/4"},{"id":"11","text":"Text mining","weight":"53","link":"\/facet\/ToolType\/11"},{"id":"30","text":"Tool development","weight":"9","link":"\/facet\/ToolType\/30"},{"id":"16","text":"Transcription","weight":"17","link":"\/facet\/ToolType\/16"},{"id":"23","text":"Video","weight":"17","link":"\/facet\/ToolType\/23"},{"id":"19","text":"Visual search","weight":"26","link":"\/facet\/ToolType\/19"},{"id":"9","text":"Visualisation","weight":"11","link":"\/facet\/ToolType\/9"},{"id":"8","text":"Visualization","weight":"70","link":"\/facet\/ToolType\/8"},{"id":"10","text":"Web development","weight":"46","link":"\/facet\/ToolType\/10"},{"id":"21","text":"Writing","weight":"22","link":"\/facet\/ToolType\/21"}]);
    </script>
@stop
