<div class="col-xs-12 col-sm-9">
    <div class="row">
        <div class="col-6 col-sm-6 col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-briefcase"></span>
                  Tools
              </div>
              <div class="panel-body">
               Count :<?php print $statistics['tool']['count'];?><br />
               <a href="#"><span class="glyphicon glyphicon-plus"></span>Add tool</a>
              </div>
            </div>            
        </div>
        <div class="col-6 col-sm-6 col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-user"></span>
                  Users
              </div>
              <div class="panel-body">
               Count :<?php print $statistics['user']['count'];?>
              </div>
            </div>            
        </div>     
        <div class="col-6 col-sm-6 col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-list-alt"></span>
                  Facets
              </div>
              <div class="panel-body">
                  <ul class="list-group">
                    <?php foreach($statistics['facet'] as $facet): ?>
                       <li class="list-group-item">
                           <span class="badge"><?php print $facet['facetTotal'];?></span>
                           <?php print $facet['facetLegend'];?><br />
                           <a href="#"><span class="glyphicon glyphicon-list"></span>List</a> <a href="#"><span class="glyphicon glyphicon-plus"></span>Add</a>
                       </li>
                    <?php endforeach;?>
                  </ul>
              </div>
            </div>            
        </div>         
    </div>
    
</div>




