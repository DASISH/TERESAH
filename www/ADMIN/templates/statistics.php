<div class="col-xs-12 col-sm-9">
    <div class="row">
        <div class="col-6 col-sm-6 col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-briefcase"></span>
                  Tools
              </div>
              <div class="panel-body action-links">
               Count :<?php print $statistics['tool']['count'];?><br />
               <a href="tool"><span class="glyphicon glyphicon-list"></span>List</a>
               <a href="#"><span class="glyphicon glyphicon-plus"></span>Add</a>
              </div>
            </div>            
        </div>
        <div class="col-6 col-sm-6 col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-user"></span>
                  Users
              </div>
              <div class="panel-body action-links">
               Count :<?php print $statistics['user']['count'];?><br />
               <a href="user"><span class="glyphicon glyphicon-list"></span>List</a>
               <a href="#"><span class="glyphicon glyphicon-plus"></span>Add</a>
              </div>
            </div>            
        </div>     
        <div class="col-6 col-sm-6 col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-inbox"></span>
                  Logs
              </div>
              <div class="panel-body action-links">
               Log entries :<br />
               <a href="#"><span class="glyphicon glyphicon-list"></span>List</a>
              </div>
            </div>            
        </div>       
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <span class="glyphicon glyphicon-list-alt"></span>
                  Facets
              </div>
              <div class="panel-body">
                    <?php foreach($statistics['facet'] as $facet => $count): ?>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php print $facet;?>
                                    <span class="badge pull-right"><?php print $count;?></span>
                                </div>
                                <div class="panel-body action-links">
                                    <a href="#"><span class="glyphicon glyphicon-list"></span>List</a> <a href="#"><span class="glyphicon glyphicon-plus"></span>Add</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                  </ul>
              </div>
            </div>            
        </div>          
    </div>
    
</div>




