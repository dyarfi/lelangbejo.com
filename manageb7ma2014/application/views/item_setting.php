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
                <li><a href="<?=site_url('item')?>">Item</a> <span class="divider">/</span></li>
                <li class="active">Setting</li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls">
                    <?php if(isset($err)){?>
                        <div class="alert alert-error error input-xxlarge">
                            <strong>Warning!</strong> <?=$err?>
                        </div>
                    <?php } ?>
                    <?php echo validation_errors();?>

                    <div class="alert alert-info input-xxlarge">
                        <strong>Penting!</strong> Silahkan pilih salah satu item untuk diaktifkan, jika item yang diaktifkan sudah terjual (laku) maka tidak dapat di bidding oleh user.
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">List item</label>
                    <div class="controls">
                        <?php foreach ($rows as $r){?>
                            <label class="radio">
                                <input name="item" type="radio" <?=$c=($r['is_active'])?'checked':''?> value="<?=$r['id']?>">
                                <?=$r['name']?> <?=$c=($r['is_finish'])?'<span class="icon-star"></span>':''?>
                            </label>
                        <?php }?>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn" href="<?=site_url('item')?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
        <?php $this->load->view('inc/footer');?>
    </body>
</html>