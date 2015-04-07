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
                <li class="active">Data</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <span class="input-xlarge uneditable-input"><?=$row->full_name?></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls">
                        <span class="input-xlarge uneditable-input"><?=$row->username?></span>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <a class="btn" href="<?=site_url('account/change_password')?>">Change password</a>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>