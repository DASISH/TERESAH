<form class="form-horizontal" role="form" action="" method="post">
	<div class="form-group">
		<label for="shortname" class="col-lg-1 control-label">Shortname</label>
		<div class="col-lg-8">
			<input name="shortname" class="form-control" placeholder="shortname" value="<?php print $tool['shortname']; ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="title" class="col-lg-1 control-label">Title</label>
		<div class="col-lg-8">
			<input name="title" class="form-control" placeholder="title" value="<?php print $tool['title']; ?>"/>
		</div>
	</div>  
 	<div class="form-group">
		<label for="homepage" class="col-lg-1 control-label">Homepage</label>
		<div class="col-lg-8">
			<input name="homepage" class="form-control" placeholder="homepage" value="<?php print $tool['homepage']; ?>"/>
		</div>
	</div>    
	<div class="form-group">
		<label for="description" class="col-lg-1 control-label">Description</label>
		<div class="col-lg-8">
			<textarea name="description" class="form-control" placeholder="description"><?php print $tool['description']; ?></textarea>
		</div>
	</div>    
</form>