<h1>Users</h1>
<table class="sortable table table-striped table-bordered">
    <thead>
        <tr>
            <th>Login</th>
            <th>Name</th>
            <th>Mail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><a href="user/<?php print $user['login']; ?>"><?php print $user['login']; ?></a></td>
            <td><?php print $user['name']; ?></td>
            <td><?php print $user['mail']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



