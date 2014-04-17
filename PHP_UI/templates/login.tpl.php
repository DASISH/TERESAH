<div class="row">
    <div class="row">
        <h2><?php print $i18n['use your social network']; ?>:</h2>
        <ul class="list-unstyled list-inline lead oauth">
            <li>
                <span class="icon-stack" onclick="location.href='/login/oauth/facebook'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-facebook"></i>
                </span>
            </li>
            <li>
                <span class="icon-stack" onclick="location.href='/login/oauth/github'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-github"></i>
                </span>
            </li>
            <li>
                <span class="icon-stack" onclick="location.href='/login/oauth/twitter'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-twitter"></i>
                </span>
            </li>
            <li>
                <span class="icon-stack" onclick="location.href='/login/oauth/google'">
                    <i class="icon-check-empty icon-stack-base"></i>
                    <i class="icon-google-plus"></i>
                </span>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2><?php print $i18n['sign in']; ?></h2>
            <?php if(isset($alert)) : ?>
                <div class="alert alert-<?php print $alert['status']; ?> text-center"><?php print $alert['message']; ?></div>		
            <?php endif; ?>
            <form class="form-signin" action="/login" method="post">
                <input class="form-control" type="text" name="user" autofocus="" placeholder="<?php print $i18n['username'] . " " . $i18n['or'] . " " . $i18n['email']; ?>">
                <input class="form-control" type="password" name="password" placeholder="<?php print $i18n['password']; ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php print $i18n['sign in']; ?></button>
            </form>
        </div>        
    </div>
    <div class="col-lg-6"><?php print $i18n['Not a user']; ?>? <a href="/signup"><?php print $i18n['Sign up']; ?></a></div>
</div>