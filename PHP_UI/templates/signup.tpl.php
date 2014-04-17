<div class="row">
    <div class="row">
        <h2><?php print $i18n['use your social network']; ?>:</h2>
        <ul class="list-unstyled list-inline lead oauth">
            <li>
                <span class="icon-stack" onclick="location.href = '/login/oauth/facebook'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-facebook"></i>
                </span>
            </li>
            <li>
                <span class="icon-stack" onclick="location.href = '/login/oauth/github'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-github"></i>
                </span>
            </li>
            <li>
                <span class="icon-stack" onclick="location.href = '/login/oauth/twitter'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-twitter"></i>
                </span>
            </li>
            <li>
                <span class="icon-stack" onclick="location.href = '/login/oauth/google'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-google-plus"></i>
                </span>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h2><?php print $i18n['Sign up']; ?></h2>
            <?php if(isset($alert)) : ?>
                <div class="alert alert-<?php print $alert['status']; ?> text-center"><?php print $alert['message']; ?></div>		
            <?php endif; ?>
            <form class="form-horizontal" role="form" action="/signup" method="post">
                <div class="form-group">
                    <label for="name" class="col-lg-4"><?php print $i18n['name']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="name" id="name" <?php if(isset($fields['name'])) : ?> value="<?php print $fields['name']; ?>" <?php endif; ?> placeholder="<?php print $i18n['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mail" class="col-lg-4"><?php print $i18n['email']; ?></label>
                    <div class="col-lg-10">
                        <input type="mail" class="form-control" name="mail" id="mail" <?php if(isset($fields['mail'])) : ?> value="<?php print $fields['mail']; ?>" <?php endif; ?> placeholder="<?php print $i18n['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user" class="col-lg-4"><?php print $i18n['username']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="user" id="user" <?php if(isset($fields['user'])) : ?> value="<?php print $fields['user']; ?>" <?php endif; ?> placeholder="<?php print $i18n['username']; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-4"><?php print $i18n['password']; ?></label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="<?php print $i18n['password']; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2" class="col-lg-4"><?php print $i18n['repeat password']; ?></label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="<?php print $i18n['repeat password']; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-primary btn-block"><?php print $i18n['Sign up']; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>