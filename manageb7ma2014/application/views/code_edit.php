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
                <li class="active">Detail - <?=$row->code?></li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls">
                    <?php echo validation_errors();?>
                </div>
                <?php if(check_page_access($this->_page_access,'code_edit' && $row->approved=='Unapproved')){?>
                    <div class="controls">
                        <div class="alert alert-info">
                            <strong>Penting!</strong> <br>
                            <ul type="number">
                                <li>Jika bottom approved di click maka member akan mendaapatkan poin, mendapat notifikasi dan data sudah tidak bisa diedit kembali.</li>
                                <li>Jika bottom rejected di click maka member akan mendapat notifikasi dan data sudah tidak bisa diedit kembali.</li>
                            </ul>
                        </div>
                    </div>
                <?php }else{?>
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <button class="btn <?=$s=($row->approved=='Approved')?'btn-success':'btn-danger'?>" type="button"><?= strtoupper($row->approved)?></button>
                        </div>
                    </div>
                <?php }?>
                
                <div class="control-group">
                    <label class="control-label">Code</label>
                    <div class="controls">
                        <input class="input-large" disabled="disabled" type="text" value="<?=$row->code?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Photo</label>
                    <div class="controls">
                        <img src="<?=_xml('url_media') .$row->file_upload?>" class="img-polaroid" />
                    </div>
                </div>
                <?php if(check_page_access($this->_page_access,'code_edit' && $row->approved=='Unapproved')){?>
                    <div class="control-group">
                        <label class="control-label">Jumlah KOIN</label>
                        <div class="controls">
                            <input class="input-small" name="point_code" maxlength="3" type="text" value="<?=set_value('point_code',3)?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" name="approved" value="1">
                            <button class="btn btn-primary" type="submit">Approved</button>
                            <a class="btn btn-danger" href="<?=site_url('code/rejected/'.$row->id)?>">Rejected</a>
                            <a class="btn" href="<?=site_url('code?action=Unapproved')?>">Cancel</a>
                        </div>
                    </div>
                <?php }?>
            </form>
        </div>
        
        <?php $this->load->view('inc/footer');?>
    </body>
</html>