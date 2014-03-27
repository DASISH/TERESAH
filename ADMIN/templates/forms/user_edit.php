<h2><?php print $title; ?></h2>

<br/>

<form class="form-horizontal" role="form" action="<?php print $form_address; ?>" method="post">

    <div class="form-group">
        <label for="name" class="col-lg-1 control-label">Name</label>
        <div class="col-lg-8">
            <input name="name" class="form-control" placeholder="name" value="<?php print isset($user['name']) ? $user['name'] : ''; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="mail" class="col-lg-1 control-label">Mail</label>
        <div class="col-lg-8">
            <input name="mail" class="form-control" placeholder="mail" value="<?php print isset($user['mail']) ? $user['mail'] : ''; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="login" class="col-lg-1 control-label">Login</label>
        <div class="col-lg-8">
            <input name="login" class="form-control" placeholder="login" value="<?php print isset($user['login']) ? $user['login'] : ''; ?>"/>
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
                        <input type="checkbox" name="user_active" <?php if (isset($user['active'])) print $user['active'] == 1 ? 'checked' : ''; ?>>
                    </span>
                    <input type="text" class="form-control" value="Active user">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-1 control-label">User level</label>
        <div class="row">
            <div class="col-lg-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="user_level" value="1" <?php if(isset($user['user_level'])) print $user['user_level'] == '1' ? 'checked' : ''; ?>>
                    </span>
                    <input type="text" class="form-control" value="Authenticated user">
                    </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="user_level" value="2" <?php if(isset($user['user_level'])) print $user['user_level'] == '2' ? 'checked' : ''; ?>>
                    </span>
                    <input type="text" class="form-control" value="Collaborator">                    
                    </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="user_level" value="3" <?php if(isset($user['user_level'])) print $user['user_level'] == '3' ? 'checked' : ''; ?>>
                    </span>
                    <input type="text" class="form-control" value="Supervisor">
                    </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="user_level" value="4" <?php if(isset($user['user_level'])) print $user['user_level'] == '4' ? 'checked' : ''; ?>>
                    </span>
                    <input type="text" class="form-control" value="Administrator">  
                </div>
            </div>
        </div>
    </div><!-- /input-group -->

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
        <?php if (isset($user['openID'])) : ?>
            <?php foreach ($user['openID'] as $openID): ?>
                <tr>
                    <td><?php print $openID['provider']; ?></a></td>
                    <td><?php print $openID['external_uid']; ?></td>            
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
