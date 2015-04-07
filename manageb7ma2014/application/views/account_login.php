<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand">Backend System - Lelang BEJO</a>
            </div>
          </div>
        </div>
        <div class="container min-content">
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Please sign in</h2>
                <div class="input-prepend">
                    <div class="add-on"><span class="icon-user"></span></div>
                    <input name="<?=en_username()?>" type="text" class="input-large" placeholder="Username">
                </div>
                <div class="input-prepend">
                    <div class="add-on"><span class="icon-lock"></span></div>
                    <input name="<?=en_password()?>" type="password" class="input-large" placeholder="Password">
                </div>
                <button class="btn btn-large btn-primary" type="submit">Sign in</button>
                <?php if(!empty ($msg)){?>
                    <div class="alert alert-error error top-20">
                        <strong>Warning!</strong> <?=$msg?>
                    </div>
                <?php } ?>
                <?=validation_errors()?>
            </form>
        </div>
        <?php $this->load->view('inc/footer');?>
    </body>
</html>