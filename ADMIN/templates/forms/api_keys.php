<h2><?php print $title; ?></h2>

<br/>

<form class="form-horizontal" role="form" action="/admin/api_keys" method="post">

    <table class="sortable table table-striped table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Public</th>
                <th>Private</th>            
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($keys as $key): ?>
                <tr class="<?php print $key['private_key'] == '' ? 'warning' : ''; ?>">
                    <td><?php print $key['user_name']; ?></a></td>
                    <td><?php print $key['public_key']; ?></a></td>
                    <td width="100" class="text-center">
                        <?php if ($key['private_key'] != ''): ?>
                            <?php print $key['private_key'] ?>
                        <?php else: ?>                            
                            Approve: <input type="checkbox" name="key_<?php print $key["api_key_uid"]; ?>" id="key_<?php print $key["api_key_uid"]; ?>">
                        <?php endif; ?>
                    </td>            
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

    <br/>
    <input class="btn btn-primary" type="submit" value="Submit">
</form>