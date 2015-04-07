<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Administrator</a> <span class="divider">/</span></li>
                <li><a href="<?=site_url('home/lists')?>">IP Blocked</a> <span class="divider">/</span></li>
                <li class="active">Add</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="controls">
                    <?php echo validation_errors();?>
                </div>
                <div class="control-group">
                    <label class="control-label">IP Address</label>
                    <div class="controls">
                    <input class="input-xlarge" type="text" name="ip_address" placeholder="IP Address" value="<?=set_value('ip_address')?>">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                    <button class="btn btn-primary" type="submit">Add IP Blocked</button>
                    <a href="<?=site_url('home/lists"')?>" class="btn">Cancel</a>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>