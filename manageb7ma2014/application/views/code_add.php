<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Manage</a> <span class="divider">/</span></li>
                <li><a href="<?=site_url('code')?>">Transaction Code</a> <span class="divider">/</span></li>
                <li class="active">Add</li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls">
                    <?php if(isset($err)){?>
                        <div class="alert alert-error error input-xxlarge">
                            <strong>Warning!</strong> <?=$err?>
                        </div>
                    <?php } ?>
                    <?php echo validation_errors();?>
                </div>
                <div class="control-group">
                    <label class="control-label">Code</label>
                    <div class="controls">
                        <input class="input-large" type="text" name="code" placeholder="Code" value="<?=set_value('code')?>">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">Add new code</button>
                        <a class="btn" href="<?=site_url('code')?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>