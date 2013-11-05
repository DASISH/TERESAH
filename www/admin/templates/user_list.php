<h1>Users</h1>

<a href="<?php print BASE_PATH; ?>user/add"><span class="glyphicon glyphicon-plus"></span> Add</a>  
<a href="#"><span class="glyphicon glyphicon-check"></span> Select all</a>
<a href="#" class="batch-action" data-batch-function="deleteUsers"><span class="glyphicon glyphicon-trash"></span> Delete</a>

<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
			<th class="sorting_disabled">&nbsp;</th>
            <th>Login</th>
            <th>Name</th>
            <th>Mail</th>
			<th>Active</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
			<td><input type="checkbox" value="<?php print $user['user_uid']; ?>" name="id[]" /></td>
            <td><a href="user/edit/<?php print $user['user_uid']; ?>"><?php print $user['login']; ?></a></td>
            <td><?php print $user['name']; ?></td>
            <td><?php print $user['mail']; ?></td>
			<td><?php print $user['active']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>