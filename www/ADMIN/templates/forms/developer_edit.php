<h2><?php print $title; ?></h2>

<br/>

<form class="form-horizontal" role="form" action="<?php print $form_address; ?>" method="post">

    <div class="form-group">
        <label for="name" class="col-lg-1 control-label">Name</label>
        <div class="col-lg-8">
            <input name="name" class="form-control" placeholder="name" value="<?php print isset($developer['name']) ? $developer['name'] : ''; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="contact" class="col-lg-1 control-label">Contact</label>
        <div class="col-lg-8">
            <input name="contact" class="form-control" placeholder="contact" value="<?php print isset($developer['contact']) ? $developer['contact'] : ''; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="type" class="col-lg-1 control-label">Type</label>
        <div class="col-lg-8">
            <input name="type" class="form-control" placeholder="source_taxonomy" value="<?php print isset($developer['type']) ? $developer['type'] : ''; ?>"/>
        </div>
    </div>

    <br/>
    <input class="btn btn-primary" type="submit" value="Submit">
</form>
