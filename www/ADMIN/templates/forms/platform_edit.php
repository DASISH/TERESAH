<h2><?php print $title; ?></h2>

<br/>

<form class="form-horizontal" role="form" action="<?php print $form_address; ?>" method="post">

	<div class="form-group">
		<label for="name" class="col-lg-1 control-label">Name</label>
		<div class="col-lg-8">
			<input name="name" class="form-control" placeholder="name" value="<?php print isset($platform['name']) ? $platform['name'] : ''; ?>"/>
		</div>
	</div>
    
    	<br/>
	<input class="btn btn-primary" type="submit" value="Submit">
</form>
