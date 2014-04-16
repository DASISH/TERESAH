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
            <?php if (isset($alert)) { ?>
                <div class="alert <?php print $alert['class']; ?>"><?php print $alert['message']; ?></div>
            <?php } ?>
            <form class="form-horizontal" role="form" action="/signup" method="post">
                <div class="form-group">
                    <label for="name" class="col-lg-4"><?php print $i18n['name']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="name" placeholder="<?php print $i18n['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-4"><?php print $i18n['email']; ?></label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" id="email" placeholder="<?php print $i18n['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-lg-4"><?php print $i18n['username']; ?></label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="username" placeholder="<?php print $i18n['username']; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password1" class="col-lg-4"><?php print $i18n['password']; ?></label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="password1" placeholder="<?php print $i18n['password']; ?>" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2" class="col-lg-4"><?php print $i18n['repeat password']; ?></label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="password2" placeholder="<?php print $i18n['repeat password']; ?>" autocomplete="off">
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