<section id="viewHeader">
    <div class="page-header">
        <h1><span><?php print $data["facet"]["facetLegend"];?></span> <small><?php print i18n('browse facets' );?></small></h1>	

        <p><?php print i18n('facets elements from' );?> <span ng-bind="ui.parameters.start + 1"></span> <?php print i18n('to' );?> <span ng-bind="ui.parameters.limit + ui.parameters.start" ng-show="ui.parameters.total > 20"></span><span ng-bind="ui.parameters.total" ng-show="ui.parameters.total < 20"></span> <?php print i18n('of' );?> <span ng-bind="ui.parameters.total"></span> <?php print i18n('available' );?></p>
    </div>
</section>
<section id="viewContent">
    <div class="row">
        <pagination total-items="results.facet.facetTotal" items-per-page="ui.pages.itemPerPage" page="ui.pages.current" max-size="5" class="pagination-small" boundary-links="true" rotate="false" on-select-page="ui.pages.change(page)" num-pages="ui.pages.total"></pagination>
    </div>
    <div class="row no-desc">
        <?php foreach($data["facets"] as $facet):?>
        <div class="row" >
            <div class="col-lg-12">
                <em><a href="/facet/<?php print $data["facet"]["facetParam"];?>/<?php print $facet["id"];?>"><?php print $facet["name"];?></a></em>
                <hr style="margin:5px;"/>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="row">
        <pagination total-items="results.facet.facetTotal" items-per-page="ui.pages.itemPerPage" page="ui.pages.current" max-size="5" class="pagination-small" boundary-links="true" rotate="false" on-select-page="ui.pages.change(page)" num-pages="ui.pages.total"></pagination>
    </div>
</section>