<!DOCTYPE html>

<html dir="ltr" lang="{{ App::getLocale() }}">

@if (PageHelper::showVersionInformation())
    <!-- TERESAH {{ Lang::get("views/shared/messages.current_version.commit_id.message") }} {{ PageHelper::getCurrentCommitId() }} ({{ PageHelper::getCurrentCommitDate() }}) -->
    <!-- Environment: {{ App::environment() }} -->
@endif

<head>
    <meta charset="utf-8" />

<!-- Title -->
    <title>@if (isset($preTitle)) {{$preTitle}} - @endif{{ Lang::get("views/pages/meta.title") }}</title>

<!-- Meta -->
    <meta name="author" content="{{ Lang::get("views/pages/meta.author") }}" />
    <meta name="description" content="{{ Lang::get("views/pages/meta.description") }}" />
    <meta name="revisit-after" content="7 days" />
    {{ PageHelper::robotsMetaTag() }}
    <meta name="viewport" content="width = device-width, initial-scale = 1.0" />

@if (isset($toolSlug))
<!-- RDF alternatives -->
    @if(in_array("XML", Config::get("teresah.tool_rdf_formats")))
    <link rel="alternate" type="application/rdf+xml" href="{{ URL::to("/tools/" . $toolSlug . ".rdfxml") }}" title="Structured Descriptor Document (RDF/XML format)" />
    @endif
    @if(in_array("Turtle", Config::get("teresah.tool_rdf_formats")))    
    <link rel="alternate" type="text/rdf+n3" href="{{ URL::to("/tools/" . $toolSlug . ".n3") }}" title="Structured Descriptor Document (N3/Turtle format)" />
    @endif
    @if(in_array("NTriples", Config::get("teresah.tool_rdf_formats")))  
    <link rel="alternate" type="text/plain" href="{{ URL::to("/tools/" . $toolSlug . ".ntriples") }}" title="Structured Descriptor Document (N-Triples format)" />
    @endif
    @if(in_array("JsonLD", Config::get("teresah.tool_rdf_formats")))     
    <link rel="alternate" type="application/ld+json" href="{{ URL::to("/tools/" . $toolSlug . ".jsonld") }}" title="Structured Descriptor Document (JSON-LD format)" />
    @endif
@endif
    
<!-- Favicon -->
    <link href="{{ url("/") }}/assets/favicon.png" rel="icon" type="image/x-icon" />

<!-- Stylesheets -->
    {{ stylesheet_link_tag() }}

<!-- JavaScripts -->
    {{ javascript_include_tag() }}
</head>
