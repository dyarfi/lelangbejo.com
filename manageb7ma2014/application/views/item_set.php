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
                <li class="active">Set Winner</li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls">
                    <?php if(isset($err)){?>
                        <div class="alert alert-error error input-xxlarge">
                            <strong>Warning!</strong> <?=$err?>
                        </div>
                    <?php } ?>

                    <div class="alert alert-info input-xxlarge">
                        <strong>Penting!</strong> Silahkan pilih salah satu user untuk jadi pemenang, jika pemenang sudah terpilih maka item tidak dapat di bidding oleh user.
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">List user</label>
                    <div class="controls">
                        <?php foreach ($rows as $r){?>
                            <label class="radio">
                                <input name="bidding_id" type="radio" value="<?=$r['id']?>"/>
                                <?=$r['user_name']?> | Rp <?=number_format($r['price'], 0, '', '.')?> | <span class="icon-calendar"></span> <?=$r['created']?>
                            </label>
                        <?php }?>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <a class="btn" href="<?=site_url('item')?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
        <?php $this->load->view('inc/footer');?>
    </body>
</html>