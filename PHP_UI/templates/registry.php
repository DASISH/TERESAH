<ol class="breadcrumb">
    <li><a href="/"><?php print $i18n['home'];?></a></li>
    <li><a href="/registry"><?php print $i18n['browse'];?></a></li>
</ol>

<section id="viewHeader">
    <div class="page-header">
        <h1><?php print $i18n['browse'];?></h1>	
        <p><?php print $i18n['tools from'];?> <?php print $tools['parameters']['start']+1; ?> <?php print $i18n['to'];?> <?php print $tools['parameters']['limit']+$tools['parameters']['start']; ?><span ng-bind="ui.parameters.total" ng-show="ui.parameters.total < 20"></span> <?php print $i18n['of'];?> <?php print $tools['parameters']['total']; ?> <?php print $i18n['available'];?></p>
    </div>
</section>
<section id="viewContent" ng-show="results.items">
    <div class="row" ng-show="ui.pages.total > 1">
        <pagination total-items="ui.parameters.total" items-per-page="ui.pages.itemPerPage" page="ui.pages.current" max-size="5" class="pagination-small" boundary-links="true" rotate="false" on-select-page="ui.pages.change(page)" num-pages="ui.pages.total"></pagination>
    </div>
    <section id="results">
    <?php foreach ($tools['response'] as $tool): ?>
        <div class="item" <?php if(empty($tool['description']['text'])):?>class="no-desc"<?php endif;?>>
            <div class="col-xs-1 ">
                <div class="container-font big-font">
                    <a style="display:block; width:100%; height:100%;" href="/tool/<?php print $tool['identifiers']['shortname']; ?>"><span class="fontello-"></span></a>
                </div>
            </div>
            <div class="col-xs-11">
                <h4><a href="/tool/<?php print $tool['identifiers']['shortname']; ?>"><?php print $tool['title']; ?></a> <span class="pull-right"><small><em><?php print $tool['description']['provider']; ?></em></small></span></h4>
                <p><?php print $tool['description']['text']; ?></p>
                <hr>
            </div>

        </div>
    </section>
    <div class="row" ng-show="ui.pages.total > 1">
        <pagination total-items="ui.parameters.total" items-per-page="ui.pages.itemPerPage" page="ui.pages.current" max-size="5" class="pagination-small" boundary-links="true" rotate="false" on-select-page="ui.pages.change(page)" num-pages="ui.pages.total"></pagination>
    </div>        
<?php endforeach; ?>
</section>