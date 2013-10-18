<h2>Edit User</h2>
<!--
<form action="<?php print $app->urlFor('user_edit_post', array('user_uid' => $user['user_uid'])); ?>" method="post">

	<div class="input-group">
		<span class="input-group-addon">Name</span>
		<input name="name" class="form-control" placeholder="name" value="<?php print $user['name']; ?>"/><br/>
	</div>
	
	<div class="input-group">
		<span class="input-group-addon">Mail</span>
		<input name="mail" class="form-control" placeholder="mail" value="<?php print $user['mail']; ?>"/><br/>
	</div>

	<div class="input-group">
		<span class="input-group-addon">Login</span>
		<input name="login" class="form-control" placeholder="login" value="<?php print $user['login']; ?>"/><br/>
	</div>
	
	<div class="input-group">
		<span class="input-group-addon">Password</span>
		<input name="password" class="form-control" placeholder="new password"/><br/>
	</div>
	
	<div class="row">
		<div class="col-lg-2">
			<div class="input-group">
				<span class="input-group-addon">
					<input type="radio" name="user_active" value="active">
				</span>
				<input type="text" class="form-control" value="active">
			</div>
		</div>
		<div class="col-lg-2">
			<div class="input-group">
				<span class="input-group-addon">
					<input type="radio" name="user_active" value="inactive"><br/>
				</span>
				<input type="text" class="form-control" value="inactive">
			</div>
		</div>
	</div>
	<br/>
	<input class="btn btn-default" type="submit" value="Submit">
</form>
<br/>
<br/>
<hr/>
<br/>
-->

<br/>
<form class="form-horizontal" role="form" action="<?php print $app->urlFor('user_edit_post', array('user_uid' => $user['user_uid'])); ?>" method="post">

	<div class="form-group">
		<label for="name" class="col-lg-1 control-label">Name</label>
		<div class="col-lg-8">
			<input name="name" class="form-control" placeholder="name" value="<?php print $user['name']; ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="mail" class="col-lg-1 control-label">Mail</label>
		<div class="col-lg-8">
			<input name="mail" class="form-control" placeholder="mail" value="<?php print $user['mail']; ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="login" class="col-lg-1 control-label">Login</label>
		<div class="col-lg-8">
			<input name="login" class="form-control" placeholder="login" value="<?php print $user['login']; ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-lg-1 control-label">Password</label>
		<div class="col-lg-8">
			<input name="password" class="form-control" placeholder="new password"/><br/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-1 control-label">Active</label>
		<div class="row">
			<div class="col-lg-2">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="radio" name="user_active" value="active">
					</span>
					<input type="text" class="form-control" value="active">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="radio" name="user_active" value="inactive"><br/>
					</span>
					<input type="text" class="form-control" value="inactive">
				</div>
			</div>
		</div>
	</div>
	<br/>
	<input class="btn btn-primary" type="submit" value="Submit">
</form>

<hr/>

<h3>Registered Open IDs</h3>

<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
            <th>Provider</th>
            <th>UID</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($user['openID'] as $openID): ?>
        <tr>
            <td><?php print $openID['provider']; ?></a></td>
            <td><?php print $openID['external_uid']; ?></td>            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
