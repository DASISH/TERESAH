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
                <tr>
                    <td><?php print $application['name']; ?></a></td>
                    <td>
                        <?php if ($application['status'] == '1'): ?>
                            <?php print 'approved' ?>
                        <?php else: ?>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="user_application" id="user_application_<?php print $application["api_application_uid"];?>">
                                </span>
                                <input type="text" class="form-control" value="Active user">
                            </div>
                        <?php endif; ?>
                    </td>            
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br/>
    <input class="btn btn-primary" type="submit" value="Submit">
</form>