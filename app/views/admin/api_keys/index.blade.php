@extends("layouts.admin")

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.api_keys.index.heading") }} <a href="{{ URL::route("admin.api.create") }}" class="button right" title="{{ Lang::get("views.shared.navigation.admin.api.create.title") }}" role="button"><span class="glyphicons circle_plus"></span> {{ Lang::get("views.shared.navigation.admin.api.create.name") }}</a></h1>

            <p>{{ Lang::get("views.admin.api_keys.index.listing_results", array("from" => $apiKeys->getFrom(), "to" => $apiKeys->getTo(), "total" => $apiKeys->getTotal())) }}</p>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <table class="responsive">
                <thead>
                    <tr>
                        <th>{{ Lang::get("models.apikey.attributes.id") }}</th>
                        <th>{{ Lang::get("models.apikey.attributes.token") }}</th>
                        <th>{{ Lang::get("models.apikey.attributes.user") }}</th>
                        <th>{{ Lang::get("models.apikey.attributes.enabled") }}</th>
                        <th>{{ Lang::get("models.apikey.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models.apikey.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("views.admin.api_keys.index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($apiKeys as $apiKey)
                        @include("admin.api_keys._api_key", compact("apiKey"))
                    @endforeach
                </tbody>
            </table>
            <!-- /responsive -->

            {{ $apiKeys->links() }}
        </div>
        <!-- /small-12 columns -->
    </section>
    <!-- /row -->
@stop
