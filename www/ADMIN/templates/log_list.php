<?php print_r($logs); ?>

<div class="page-header">
    <h1>Logs</h1>
    <div class="toolbox-fixed">
        <!--
        <a href="<?php print BASE_PATH; ?>tool/add"><span class="glyphicon glyphicon-plus"></span> Add</a>  
        <a href="#"><span class="glyphicon glyphicon-check"></span> Select all</a>
        <a href="#" class="batch-action" data-batch-function="deleteTools"><span class="glyphicon glyphicon-trash"></span> Delete</a>
        --> 
    </div>
</div>

<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
            <th class="sorting_disabled">&nbsp;</th>
            <th>User</th>
            <th>Action</th>
            <th>Timestamp</th>
			<th>Table</th>
			<th>UID</th>
		</tr>
    </thead>
    <tbody>
        <?php foreach($logs as $log): ?>
        <tr>
            <td><input type="checkbox" value="<?php print $log['system_log_uid']; ?>" name="id[]" /></td>
            <td><a href="log/<?php print $log['system_log_uid']; ?>"><?php print $log['login']; ?></a></td>
            <td><?php print $log['action']; ?></td>
            <td><?php print $log['timestamp']; ?></td>
            <td><?php print $log['table']; ?></td>
            <td><?php print $log['table_uid']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


