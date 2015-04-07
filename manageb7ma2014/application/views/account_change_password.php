<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="<?=site_url('account/profile')?>">Profile</a> <span class="divider">/</span></li>
                <li class="active">Change password</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="controls">
                    <?php if($status=='success'){?>
                        <div class="alert alert-success error input-xlarge">
                            <strong>Success!</strong> Update data success.
                        </div>
                    <?php }?>
                    <?php if($status=='error'){?>
                        <div class="alert alert-error error input-xlarge">
                            Your current password not match!
                        </div>
                    <?php }?>
                    <?php echo validation_errors();?>
                </div>
                <div class="control-group">
                    <label class="control-label">Current Password</label>
                    <div class="controls">
                        <input class="input-xlarge" type="password" name="current" placeholder="Current Password">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">New Password</label>
                    <div class="controls">
                        <input class="input-xlarge" type="password" name="password" placeholder="New Password">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Password Confirmation</label>
                    <div class="controls">
                        <input class="input-xlarge" type="password" name="passconf" placeholder="Password Confirmation">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
     
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>