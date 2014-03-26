<div class="page-header">
    <h1>Users</h1>
    <div class="toolbox-fixed">
        <a href="<?php print BASE_PATH; ?>user/add"><span class="glyphicon glyphicon-plus"></span> Add</a>  
        <a href="#"><span class="glyphicon glyphicon-check"></span> Select/deselect all</a>
        <a href="#" class="batch-action" data-batch-function="deleteFacet"><span class="glyphicon glyphicon-trash"></span> Delete</a>    
    </div>
</div>

<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
            <th class="sorting_disabled">&nbsp;</th>
            <th>Login</th>
            <th>Name</th>
            <th>Mail</th>
            <th>Active</th>
            <th>Admin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><input type="checkbox" value="<?php print $user['user_uid']; ?>" name="id[]" /></td>
                <td><a href="user/edit/<?php print $user['user_uid']; ?>"><?php print $user['login']; ?></a></td>
                <td><?php print $user['name']; ?></td>
                <td><?php print $user['mail']; ?></td>
                <td><?php print $user['active'] == 1 ? 'x' : ''; ?></td>
                <td><?php print $user['user_level_text']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>