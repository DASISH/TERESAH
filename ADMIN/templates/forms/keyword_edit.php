<h2><?php print $title; ?></h2>

<br/>

<form class="form-horizontal" role="form" action="<?php print $form_address; ?>" method="post">

    <div class="form-group">
        <label for="name" class="col-lg-1 control-label">Keyword</label>
        <div class="col-lg-8">
            <input name="name" class="form-control" placeholder="keyword" value="<?php print isset($keyword['keyword']) ? $keyword['keyword'] : ''; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="source_uri" class="col-lg-1 control-label">Source URI</label>
        <div class="col-lg-8">
            <input name="source_uri" class="form-control" placeholder="source_uri" value="<?php print isset($keyword['source_uri']) ? $keyword['source_uri'] : ''; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="source_taxonomy" class="col-lg-1 control-label">Source taxonomy</label>
        <div class="col-lg-8">
            <input name="source_taxonomy" class="form-control" placeholder="source_taxonomy" value="<?php print isset($keyword['source_taxonomy']) ? $keyword['source_taxonomy'] : ''; ?>"/>
        </div>
    </div>

    <br/>
    <input class="btn btn-primary" type="submit" value="Submit">
</form>
