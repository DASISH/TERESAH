<div class="container">

    <h2>Edit Profile</h2>

    <form class="form-horizontal" role="form" action="/profile" method="post">
        <?php if (isset($alert)) { ?>
            <div class="alert <?php print $alert['class']; ?>"><?php print $alert['message']; ?></div>
        <?php } ?>
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label"><?php print $i18n['name']; ?></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="name" placeholder="<?php print $_SESSION['user']['name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-lg-2 control-label"><?php print $i18n['email']; ?></label>
            <div class="col-lg-10">
                <input type="email" class="form-control" id="email" placeholder="<?php print $_SESSION['user']['email']; ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="login" class="col-lg-2 control-label"><?php print $i18n['username']; ?></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="login" placeholder="<?php print $_SESSION['user']['login']; ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="password1" class="col-lg-2 control-label"><?php print $i18n['password']; ?></label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="password1"placeholder="<?php print $i18n['New password']; ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="password2" class="col-lg-2 control-label"><?php print $i18n['repeat password']; ?></label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="password2" placeholder="<?php print $i18n['repeat password']; ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-2">
                <button type="submit" class="btn btn-primary btn-block"><?php print $i18n['update profile']; ?></button>
            </div>
        </div>
    </form>
    <br/>

    <hr />

    <h3>Registered API Keys</h3>

    <table class="sortable table table-striped table-bordered">
        <thead>
            <tr>
                <th>Domain</th>
                <th>Public Key</th>
                <th>Private Key</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($keys as $key) { ?>
                <tr>
                    <td><?php print $key['domain']; ?></td>
                    <td><?php print $key['public_key']; ?></td>
                    <td><?php print $key['private_key']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br/>

    <hr />

    <h3>Apply for API Key</h3>

    <form class="form-horizontal" role="form" action="/profile/apply" method="post">
        <?php if (isset($alert)) { ?>
            <div class="alert <?php print $alert['class']; ?>"><?php print $alert['message']; ?></div>
        <?php } ?>
        <div class="form-group">
            <label for="domain" class="col-lg-2 control-label"><?php print $i18n['domain']; ?></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="domain">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-2">
                <button type="submit" class="btn btn-primary btn-block"><?php print $i18n['apply for api key']; ?></button>
            </div>
        </div>
    </form>

</div>