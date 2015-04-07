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
                <li><a href="<?=site_url('account/lists')?>">Admin</a> <span class="divider">/</span></li>
                <li class="active">Edit</li>
            </ul>
            <form method="post" class="form-horizontal">
                <div class="controls">
                <?php if(!empty ($status)){?>
                    <?php if($status=='username'){?>
                        <div class="alert alert-error error input-xlarge">
                            <strong>Warning!</strong> Username sudah diguakan
                        </div>
                    <?php }?>
                <?php } ?>

                <?php echo validation_errors();?>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="control-group">
                            <label class="control-label">Name</label>
                            <div class="controls">
                            <input class="input-xlarge" type="text" name="full_name" placeholder="Name" value="<?=$row->full_name?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Username</label>
                            <div class="controls">
                            <input class="input-xlarge" type="text" name="username" placeholder="Username" value="<?=$row->username?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                            <input class="input-xlarge" type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Role</label>
                            <div class="controls">
                                <label class="radio inline">
                                    <input type="radio" name="role" value="<?=_xml('role_dev')?>" <?=$v = $row->role==_xml('role_dev') ? 'checked' :''?>>Developer
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="role" value="<?=_xml('role_adm')?>" <?=$v = $row->role==_xml('role_adm') ? 'checked' :''?>>Admin
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Page Access</label>
                            <div class="controls">
                                <?php foreach ($page as $r){?>
                                    <label class="checkbox">
                                        <input name="page_access[]" type="checkbox" <?=$c=(check_page_access($row->page_access,$r['id']))?'checked':''?> value="<?=$r['id']?>">
                                        <?=$r['name']?>
                                    </label>
                                <?php }?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Lock</label>
                            <div class="controls">
                            <label class="checkbox inline">
                                <input name="is_lock" <?=$v = $row->is_lock ? 'checked' :''?> type="checkbox" value="on">Is lock
                            </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="<?=site_url('account')?>" class="btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>