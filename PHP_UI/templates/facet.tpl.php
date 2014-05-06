<section id="viewHeader" class="ng-scope">
    <div class="page-header">
        <h1 class="ng-binding"><?php print i18n("Browse facets");?></h1>		
    </div>
</section>
<section id="viewContent">
    <ul class="list-inline">
        <?php foreach($data as $facet): ?>
        <li class="col-lg-3 ng-scope" style="text-align:center; margin-bottom:30px;">
            <a class="btn btn-lg btn-primary" href="/facet/<?php print $facet["facetParam"];?>"><span><?php print $facet["facetLegend"];?></span> <span class="badge"><?php print $facet["facetTotal"];?></span></a>
        </li>
        <?php endforeach;?>
    </ul>
</section>