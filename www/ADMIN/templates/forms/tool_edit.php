<h2>Edit tool</h2>

<form class="form-horizontal" role="form" action="/admin/tool/<?php print $tool['tool']['shortname']; ?>" method="POST">
    <div class="form-group">
        <label for="shortname" class="col-lg-1 control-label">Shortname</label>
        <div class="col-lg-8">
            <input name="shortname" class="form-control" placeholder="shortname" value="<?php print $tool['tool']['shortname']; ?>"/>
        </div>
    </div>
    <?php foreach ($tool['description'] as $index => $description): ?>
        <div class="panel panel-default">
            <div class="panel-heading">Description <span class="badge">#<?php print $index; ?></span></div>
            <div class="panel-body">    
                <div class="form-group">
                    <label for="description[][title]" class="col-lg-1 control-label">Title</label>
                    <div class="col-lg-8">
                        <input name="title" class="form-control" placeholder="title" value="<?php print $description['title']; ?>"/>
                    </div>
                </div>  
                <div class="form-group">
                    <label for="description[][registered]" class="col-lg-1 control-label">Registered</label>
                    <div class="col-lg-8">
                        <input name="description[][registered]" class="form-control" placeholder="title" value="<?php print $description['registered']; ?>"/>
                    </div>
                </div>                  
                <div class="form-group">
                    <label for="homepage" class="col-lg-1 control-label">Homepage</label>
                    <div class="col-lg-8">
                        <input name="homepage" class="form-control" placeholder="homepage" value="<?php print $description['homepage']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-lg-1 control-label">Description</label>
                    <div class="col-lg-8">
                        <textarea name="description" class="form-control" placeholder="description"><?php print $description['description']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>              
    <?php endforeach; ?>

    <?php foreach ($tool['external_description'] as $index => $description): ?>
        <div class="panel panel-default">
            <div class="panel-heading">External description <span class="badge">#<?php print $index; ?></span></div>
            <div class="panel-body">                     
                <div class="form-group">
                    <label for="source_uri" class="col-lg-1 control-label">Source</label>
                    <div class="col-lg-8">
                        <input name="source_uri" class="form-control" placeholder="source_uri" value="<?php print $description['source_uri']; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="registry_name" class="col-lg-1 control-label">Registry</label>
                    <div class="col-lg-8">
                        <input name="registry_name" class="form-control" placeholder="registry name" value="<?php print $description['registry_name']; ?>"/>
                    </div>
                </div>                
                <div class="form-group">
                    <label for="external_description[][description]" class="col-lg-1 control-label">Description</label>
                    <div class="col-lg-8">
                        <textarea name="external_description[<?php print $description['external_description_uid']; ?>][description]" class="form-control" placeholder="description"><?php print $description['description']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>              
    <?php endforeach; ?>

    <div class="panel panel-default">
        <div class="panel-heading">Keywords</span></div>
        <div class="panel-body">    
            <ul class="list-group">
                <?php foreach ($tool['keyword'] as $index => $keyword): ?>
                    <li class="list-group-item"><?php print $keyword['keyword']; ?><?php if($keyword['source_uri']):?> <span class="badge"><?php print $keyword['source_uri']; ?></span><?php endif;?></li>
                    <?php endforeach; ?>
            </ul>
            
                <div class="form-group">
                    <label for="autocomplete_keyword" class="col-lg-1 control-label">Add</label>
                    <div class="col-lg-8">
                        <input name="autocomplete_keyword" class="form-control" placeholder="title" />
                        <input type="button" class="btn btn-default" name="add_keyword" value="Add" />
                    </div>
                </div>              
        </div>
    </div>

    <input type="submit" class="btn btn-default" value="Save" />
</form>


<pre class="well well-lg">
    <?php print_r($tool); ?>
</pre>