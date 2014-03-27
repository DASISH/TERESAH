<h2><?php print $title; ?></h2>

<br/>

<form class="form-horizontal" role="form" action="/admin/user/api_applications" method="post">

    <table class="sortable table table-striped table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $application): ?>
                <tr class="<?php print $application['status'] == '1' ? 'success' : 'warning'; ?>">
                    <td><?php print $application['user_name']; ?></a></td>
                    <td width="100" class="text-center">
                        <?php if ($application['status'] == '1'): ?>
                            <?php print 'approved' ?>
                        <?php else: ?>                            
                            <input type="checkbox" name="user_application_<?php print $application["api_key_application_uid"]; ?>" id="user_application_<?php print $application["api_key_application_uid"]; ?>">
                        <?php endif; ?>
                    </td>            
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br/>
    <input class="btn btn-primary" type="submit" value="Submit">
</form>