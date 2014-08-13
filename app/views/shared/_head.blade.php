<!DOCTYPE html>

<html dir="ltr" lang="{{ App::getLocale() }}">

<!-- TERESAH {{ Lang::get("views/shared/messages.current_version.message") }} {{ PageHelper::getCurrentCommitId() }} -->
<!-- Environment: {{ App::environment() }} -->

<head>
    <meta charset="utf-8" />

<!-- Title -->
    <title>{{ Lang::get("views/pages/meta.title") }}</title>

<!-- Meta -->
    <meta name="author" content="{{ Lang::get("views/pages/meta.author") }}" />
    <meta name="description" content="{{ Lang::get("views/pages/meta.description") }}" />
    <meta name="revisit-after" content="7 days" />
    {{ PageHelper::robotsMetaTag() }}
    <meta name="viewport" content="width = device-width, initial-scale = 1.0" />

<!-- Favicon -->
    <link href="{{ url("/") }}/assets/favicon.png" rel="icon" type="image/x-icon" />

<!-- Stylesheets -->
    {{ stylesheet_link_tag() }}

<!-- JavaScripts -->
    {{ javascript_include_tag() }}
</head>
