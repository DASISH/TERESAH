
<form class="form-horizontal" role="form" action="" method="post">
    <div class="form-group">
        <label for="shortname" class="col-lg-1 control-label">Shortname</label>
        <div class="col-lg-8">
            <input name="shortname" class="form-control" placeholder="shortname" value="<?php print $tool['tool']['shortname']; ?>"/>
        </div>
    </div>
    <?php foreach($tool['description'] as $description): ?>
        <div class="form-group">
            <label for="description[][title]" class="col-lg-1 control-label">Title</label>
            <div class="col-lg-8">
                <input name="title" class="form-control" placeholder="title" value="<?php print $description['title']; ?>"/>
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
    <?php endforeach;?>
    
    <?php foreach($tool['external_description'] as $external_description): ?>
        <div class="form-group">
            <label for="external_description[][source_uri]" class="col-lg-1 control-label">Source</label>
            <div class="col-lg-8">
                <input name="title" class="form-control" placeholder="title" value="<?php print $external_description['source_uri']; ?>"/>
            </div>
        </div>     
         <div class="form-group">
            <label for="external_description" class="col-lg-1 control-label">Description</label>
            <div class="col-lg-8">
                <textarea name="external_description" class="form-control" placeholder="description"><?php print $external_description['description']; ?></textarea>
            </div>
        </div>   
    <?php endforeach;?>
</form>

<pre>
    <?php print_r($tool); ?>
</pre>